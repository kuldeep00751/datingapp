<?php

namespace App\Http\Controllers;

use App\Models\MeetingResponse;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Notification;
use App\Models\Notification;
use App\Notifications\SubscriptionAlert;
use App\Mail\SubscriptionDueAlert;
use App\Models\UserLikes;
use App\Models\Feedback;
use App\Models\Subscription;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingFeedback;
use App\Mail\ReceivedComment;
use App\Events\NotificationEvent;
use App\Mail\RejectProfileMail;
use App\Mail\RejectInvitationMail;
use Illuminate\Support\Facades\App;

class MeetingController extends Controller
{
    public function askMeetingDate()
    {
        $user_like_id = auth()->user()->likeUserData()->first();

        $messageMeetingResponse = MeetingResponse::where('user_like_id', $user_like_id->id)->where('status',1)->exists();

        return view('meeting.ask_date',compact('messageMeetingResponse'));
    }
    
    public function likeToContinue()
    {
        $user_id = auth()->id();
        $user_like = auth()->user()->likeUserData()->first();
        $message = false;
        if (!$user_like) {
            abort(404, __('controllerText.MeetingController_1'));
        }

        if ($user_like->meeting_status == 1) {
            $response = MeetingResponse::where('user_id', $user_id)
                                    ->where('user_like_id', $user_like->liked_user_id)
                                    ->first();

            $likedUserResponse = MeetingResponse::where('user_id', $user_like->liked_user_id)
                                                ->where('user_like_id', $user_id)
                                                ->first();
          
            if ($response && $response->already_meet == 'yes') {
                $userContinue = $response->continue_meet;
                $likedContinue = $likedUserResponse->continue_meet ?? null;

                // If either user said "No" or "Yes", go to feedback
                if ((($userContinue === 'yes' || $userContinue === 'no' || $userContinue == null) && $likedContinue === 'no') || (($likedContinue === 'yes' || $likedContinue === 'no' || $likedContinue == null) && $userContinue === 'no')) {
                    
                    return redirect()->route('meeting.sendFeedback');
                }
                
                if (($userContinue === 'yes' || $userContinue === 'no') && $likedContinue === 'yes') {
                    
                    return redirect()->route('meeting.sendFeedback');
                }

                if (($userContinue === 'yes') && is_null($likedContinue)) {
                    $message = true;
                    return view('meeting.liketo_continue',compact('message'));
                }
    
                // If both haven't answered yet
                if (is_null($userContinue) && is_null($likedContinue)) {
                    return view('meeting.liketo_continue',compact('message'));
                }

                // If one hasn't answered, wait for the other
                // if (is_null($userContinue) || is_null($likedContinue)) {
                //     return view('meeting.liketo_continue',compact('message'));
                // }

                // Default to feedback if all conditions pass but don't match above
                return view('meeting.liketo_continue',compact('message'));
            }

            return view('meeting.liketo_continue',compact('message'));
        }

        // Optional fallback (can be removed if meeting_status is always expected to be 1)
        return view('meeting.liketo_continue',compact('message'));
    }


    public function followUp()
    {
        $user_id = auth()->id();
        $meeting_user_id = getAcceptInvite();
        $user_like = auth()->user()->likeUserData()->first();

        if (!$user_like) {
            abort(404, __('controllerText.MeetingController_2'));
        }

        if ($user_like->meeting_status == 1) {
            $response = MeetingResponse::where('user_id', $user_id)
                                    ->where('user_like_id', $user_like->liked_user_id)
                                    ->first();

            $likedUserResponse = MeetingResponse::where('user_id', $user_like->liked_user_id)
                                                ->where('user_like_id', $user_id)
                                                ->first();

            if ($response && $response->already_meet == 'yes') {
                
                // Case 1: Redirect to feedback
                if (
                    $response->continue_meet == 'yes' || 
                    $response->continue_meet == 'no' || 
                    ($likedUserResponse && $likedUserResponse->continue_meet == 'no')
                ) {
                    return redirect()->route('meeting.sendFeedback');
                }

                if (
                    is_null($response->continue_meet) &&
                    ($likedUserResponse && $likedUserResponse->continue_meet == 'no')
                ) {
                    return redirect()->route('meeting.sendFeedback');
                }

                // Case 2: Show like-to-continue
                if (
                    is_null($response->continue_meet) ||
                    ($likedUserResponse && is_null($likedUserResponse->continue_meet))
                ) {
                    return redirect()->route('meeting.likeToContinue');
                }
            }

            // Default view if not yet met or no conditions met
            return view('meeting.follow_up');
        }

        if ($user_like->meeting_status == 0) {
            return view('meeting.follow_up');
        }
    }

    public function sendFeedback()
    {
        $user_id=auth()->user()->id;
        $matchUserId = auth()->user()->match_user_id;
        $user_like_id  = end($matchUserId);
        
        $feedback=[];

        $feedback = Feedback::where('user_id', $user_id)
                        ->where('like_user_id', $user_like_id)
                        ->first();
        return view('meeting.feedback',compact('feedback'));
    }
    
    public function storeMeetingDate(Request $request)
    {
       $user_like_id = auth()->user()->likeUserData()->first();

        $request->validate([
            'meeting_date' => 'required|date',
            'meeting_place' => 'required',
        ]);

        MeetingResponse::create([
            'user_id' => auth()->user()->id,
            'user_like_id' => $user_like_id->id,
            'meeting_date' => $request->meeting_date,
            'meeting_place' => $request->meeting_place,
            'status' => 1,
        ]);

        $user_like_id->update([
            'meeting_status' => 1,
        ]);

        return redirect()->route('meeting.askForMeeting');
    }

    public function askMeetingStatus()
    {
        $user_like_id = auth()->user()->likeUserData()->first();
        $messageMeetingResponse = MeetingResponse::where('user_like_id', $user_like_id->liked_user_id)->where('status',2)->exists();

        return view('meeting.ask_status',compact('messageMeetingResponse'));
    }

    public function storeMeetingStatus(Request $request)
    {
        $user_like_id = auth()->user()->likeUserData()->first();
        $request->validate([
            'meeting_status' => 'required',
        ]);

        $meetingResponse = MeetingResponse::where('user_id', auth()->user()->id)->first();
        $meetingResponse->update([
            'status' => 2,
            'meeting_status' => $request->meeting_status,
        ]);

        $user_like_id->update([
            'meeting_status' => 3,
        ]);

        return redirect()->route('meeting.meetingstatus');
    }


    public function askCancelConnection()
    {
        $user_like_id = auth()->user()->likeUserData()->first();

        if($user_like_id == null){
            return redirect()->route('users.show-user',auth()->user()->id);
        }

        $messageMeetingResponse = MeetingResponse::where('user_like_id', $user_like_id->liked_user_id)->where('status',7)->exists();

        return view('meeting.cancel_connection',compact('messageMeetingResponse'));
    }


    public function followUpResponse(Request $request)
    {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        $user_like_id = auth()->user()->likeUserData()->first();
        

        $request->validate([
            'already_meet' => 'required|string|in:yes,no', 
        ]);

        if($user_like_id->meeting_status==0){
            
            $response=MeetingResponse::create([
                'user_id' => auth()->user()->id,
                'user_like_id' => $user_like_id->liked_user_id,
                'already_meet'=>$request->already_meet,
                'status' => 1,
            ]);
            
            $user_like_id->update(['meeting_status' => 1]);

            $likeUserresponse = MeetingResponse::where('user_id', $user_like_id->liked_user_id)->where('user_like_id', $user_id)->first();
        }else{
            
            $response = MeetingResponse::where('user_id', $user_id)->where('user_like_id', $user_like_id->liked_user_id) 
            ->update(['already_meet' => $request->already_meet]);

            $likeUserresponse = MeetingResponse::where('user_id', $user_like_id->liked_user_id)->where('user_like_id', $user_id)->where('status',1)->first();
        }
        
        if ($response) {
            return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_3') ,'likeUserresponse' =>$likeUserresponse]);
        } else {
            return response()->json(['success' => false, 'message' => __('controllerText.MeetingController_4')]);
        }
    }

    public function storelikeToContinue(Request $request)
    {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        $user_like_id = auth()->user()->likeUserData()->first();
        // Validate incoming request
        $request->validate([
            'continue_meet' => 'required|string|in:yes,no', 
        ]);

       
        $response = MeetingResponse::where('user_id', $user_id)->where('user_like_id', $user_like_id->liked_user_id)->where('already_meet', 'yes') 
        ->update(['continue_meet' => $request->continue_meet]);
        
        $user_like_id->update(['is_feedback_pending' => 1]);

        $likedUserResponse = MeetingResponse::where('user_id', $user_like_id->liked_user_id)->where('user_like_id', $user_id)
        ->where('already_meet', 'yes')->first();

        DB::table('user_likes')->where('user_id', $user_like_id->liked_user_id)->where('liked_user_id', $user_id)->update(['is_feedback_pending'=>1]);

        if($request->continue_meet == 'yes' && $likedUserResponse && $likedUserResponse->continue_meet == 'yes'){
            Subscription::where('user_id', auth()->id())->update(['status' => 'paused', 'paused_hide'=>1, 'renew_status'=>1]);
            Subscription::where('user_id', $user_like_id->liked_user_id)->update(['status' => 'paused', 'paused_hide'=>1,'renew_status'=>1]);
        }

        if ($response) {
            return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_5')]);
        } else {
            return response()->json(['success' => false, 'message' => __('controllerText.MeetingController_6')]);
        }
    }

    public function storeCancelConnection(Request $request)
    {
        $user_like_id = auth()->user()->likeUserData()->first();
        $request->validate([
            'cancel_status' => 'required',
            'cancel_reason' => '',
        ]);

        $meetingResponse = MeetingResponse::where('user_id', auth()->user()->id)->first();
        $meetingResponse->update([
            'status' => 4,
            'cancel_status'=>$request->cancel_status,
            'cancel_reason' => $request->cancel_reason,
        ]);
        
        if($request->cancel_status == 1){
            $user_like_id->update([
                'affection' =>'exit',
                'meeting_status' => 8,
            ]);
        }

        return redirect()->route('cancel.connection');
    }

    public function askMoreTime()
    {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        $user_like_id = auth()->user()->likeUserData()->first();
        
        if($user_like_id->meeting_status==2)
        {
            $response = MeetingResponse::where('user_id', $user_id)->where('user_like_id', $user_like_id->liked_user_id)->where('already_meet', 'yes')->where('continue_meet', 'yes')->orwhere('continue_meet', 'no')->first();
            if($response)
            {
                return redirect()->route('meeting.sendFeedback');
            }
            else
            {
                return view('meeting.ask_more_time');
            }
        }
    }

    public function storeMoreTime(Request $request)
    {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        $user_like_id = auth()->user()->likeUserData()->first();
        // Validate incoming request
        $request->validate([
            'more_time_status' => 'required|string|in:yes,no', 
        ]);

        $response = MeetingResponse::where('user_id', $user_id)->where('user_like_id', $user_like_id->liked_user_id)->where('already_meet', 'yes')->where('continue_meet', 'yes')
        ->update(['more_time_status' => $request->more_time_status]);
        
        if ($response) {
            return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_7')]);
        } else {
            return response()->json(['success' => false, 'message' => __('controllerText.MeetingController_8')]);
        }
    }

    public function sendReminder(MeetingResponse $meetingResponse)
    {
        // Send an alert to remind them to answer
        Alert::create([
            'user_id' => $meetingResponse->user_id,
            'message' => 'Reminder: Please confirm your meeting status.',
        ]);
    }

    public function sendSubscriptionAlert()
    {
        $userDetail = getUserDetails(auth()->user()->id);
        if (!empty($userDetail->local)) {
            App::setLocale($userDetail->local);
        }
        Mail::to($userDetail->email)->send(new SubscriptionDueAlert($userDetail)); 
        App::setLocale(config('app.locale'));
        $message_subscription = ucfirst($userDetail->like_to_be_called) ." Your subscription is nearing its end!Please subscribe to continue";
        $message_spanish_subscription = ucfirst($userDetail->like_to_be_called) ." ¡Tu suscripción está por terminar! Por favor suscríbete para continuar";

        $link = route('user.subscription.index');
        $data = [
            "user_id" => $userDetail->id, 
            "to_id" =>  $userDetail->id,     
            "message" => $message_subscription,
            "message-spanish" => $message_spanish_subscription,
            "link" => $link,   
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(),
        ];

        Notification::create($data);
        
        $unseenNotiCount = getUnseenNotification();
        $userId = $userDetail->id;

        event(new NotificationEvent($userId, $unseenNotiCount));

        return 1;
    }

    public function getComments()
    {
        $user_id=auth()->user()->id;
        $matchUserId = auth()->user()->match_user_id;

        if (is_array($matchUserId)) {
            $user_like_id = end($matchUserId);
        } else {
            $user_like_id = $matchUserId; 
        }
    
        $comments=[];

        $comments = DB::table('user_likes')->where('user_id', $user_like_id)->where('liked_user_id', $user_id)->first();
        return view('meeting.comment',compact('comments'));
    }

    public function setComments(Request $request)
    {
        $user_id=auth()->user()->id;
        $matchUserId = auth()->user()->match_user_id;

        if (is_array($matchUserId)) {
            $user_like_id = end($matchUserId);
        } else {
            $user_like_id = $matchUserId; 
        }

        if($request->visual_picture && $request->visual_picture == "on"){
            $reasonProfile0 = ($request->reason_profile0 == "on")?1:0;
            $reasonProfile1 = ($request->reason_profile1== "on")?1:0;
           $visualPicture =  ($request->visual_picture== "on")?1:0;
        }else{
            $reasonProfile0 = 0;
            $reasonProfile1 = 0;
           $visualPicture = 0;
        }


        if($request->visual_description && $request->visual_description == "on"){
            $reasonDescription = $request->reason_description;
            $visualDescription = ($request->visual_description == "on")?1:0;
        }else{
            $reasonDescription = null;
            $visualDescription = 0;
        }

        $updatedRows1 = DB::table('user_likes')
            ->where('user_id', $user_like_id)
            ->where('liked_user_id', $user_id)
            ->update([
                'visualPicture' => $visualPicture,
                'visualDescription' => $visualDescription,
                'reason_profile0'=>$reasonProfile0 ,
                'reason_profile1'=>$reasonProfile1 ,
                'reason_description'=>$reasonDescription,
                'comments'=>$request->comments,
                'is_connect' => 0,
            ]);

            $updatedRows = DB::table('user_likes')
                    ->where('user_id', $user_id)
                    ->where('liked_user_id', $user_like_id)
                    ->update(['is_connect' => 0]);

            $userExists1 = User::find($user_id);
            // $profile = User::find($request->reject_user_id);
            
            $userExists1->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
            // $profile->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                    
            return back()->with('success-comment',  __('controllerText.MeetingController_10'));
    }

    public function haveDate(Request $request): JsonResponse
    {
        $request->validate([
            'reject_user_id' => 'required',
            'have_date' => 'required',
        ]);

        $user_id = auth()->id();
        $updated = DB::table('user_likes')
            ->where('user_id', $user_id)
            ->where('liked_user_id', $request->reject_user_id)
            ->update(['have_date' => $request->have_date]);
        
        $link = $request->have_date === 'yes' ? 'feedback' : 'comment';
        return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_11') ,'link'=>$link]);
    }

    public function storeFeedback(Request $request): JsonResponse
    {
        $request->validate([
            'reject_user_id' => 'required',
            'have_date' => 'required',
        ]);

        $user_id = auth()->id();
        $updated = DB::table('user_likes')
            ->where('user_id', $user_id)
            ->where('liked_user_id', $request->reject_user_id)
            ->update(['have_date' => $request->have_date]);
        
        $link = $request->have_date === 'yes' ? 'feedback' : 'comment';
        return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_11') ,'link'=>$link]);
    }

    public function storeComment(Request $request): JsonResponse
    {
        $request->validate([
            'reject_user_id' => 'required',
            'have_date' => 'required',
        ]);

        $user_id = auth()->id();
        $updated = DB::table('user_likes')
            ->where('user_id', $user_id)
            ->where('liked_user_id', $request->reject_user_id)
            ->update(['have_date' => $request->have_date]);
        
        return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_11')]);
    }


    public function feedbackSubmit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'manners' => 'required|integer|between:1,5',
            'photogenic' => 'required|integer|between:1,5',
            'expressiveness' => 'required|integer|between:1,5',
            'opinions_ideas' => 'required|integer|between:1,5',
            'energy' => 'required|integer|between:1,5',
            'willingness' => 'required|integer|between:1,5',
            'attention' => 'required|integer|between:1,5',
            'sense_humer' => 'required|integer|between:1,5',
            //'comfortable_environment' => 'required',
            'serious_relationship' => 'required',
            'not_connect' => 'nullable|string',
            'connect_person' => 'nullable|string',
            'compliment' => 'nullable|string',
            // 'approximateduration' => 'required',
            //'comments' => 'nullable|string',
        ]);

        try {
            $feedback = Feedback::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'like_user_id' => $request->feedback_user,
                ],
                [
                    'meeting_id' => 0,
                    'like_user_id' => $request->feedback_user,
                    'manners' => $request->manners,
                    'photogenic' => $request->photogenic,
                    'expressiveness' => $request->expressiveness,
                    'opinions_ideas' => $request->opinions_ideas,
                    'energy' => $request->energy,
                    'willingness' => $request->willingness,
                    'attention' => $request->attention,
                    'sense_humer' => $request->sense_humer,
                    //'comfortable_environment' => $request->comfortable_environment,
                    'serious_relationship' => $request->serious_relationship,
                    'not_connect' => $request->not_connect ?? null,
                    'connect_person' => $request->connect_person ?? null,
                    'compliment' => $request->compliment ?? null,
                    //'approximateduration' => $request->approximateduration,
                    //'comments' => $request->comments ?? null,
                    'is_feedback_pending' => 0,
                ]
            );

            $profile = User::find($request->feedback_user);

            $link = route('meeting.showFeedbacks');

            // $feedbacks = Feedback::where('user_id', auth()->id())
            //         ->where('like_user_id', $request->feedback_user)
            //         ->count();

            if($profile->is_subscribed == 1){
                
                $updated = DB::table('user_likes')
                    ->where('user_id', $request->feedback_user)
                    ->where('liked_user_id', auth()->id());
                $dataUpdatedUser = $updated->first();  
    
                DB::table('user_likes')
                    ->where('user_id', auth()->id())
                    ->where('liked_user_id', $request->feedback_user)
                    ->update(['is_feedback_pending' => 0,'want_to_continue' => $request->serious_relationship]);

                if($request->serious_relationship && $request->serious_relationship =="No"){
                   
                    $userExists1 = User::find(auth()->user()->id);
                    $profile = User::find($request->feedback_user);

                    $messageUpdate =  $userExists1->like_to_be_called  . " We wanted to update you—". $profile->like_to_be_called . " has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.";

                    $messageUpdate_spanish =  $userExists1->like_to_be_called  . " Queríamos informarte—". $profile->like_to_be_called . " ha decidido explorar un camino diferente esta vez. Pero no te preocupes, The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.";

                    $dataUpdate = [
                        "user_id" => $request->feedback_user, 
                        "to_id" =>  auth()->user()->id,     
                        "message" => $messageUpdate,
                        "message-spanish" => $messageUpdate_spanish,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
                    
                    $notification = Notification::create($dataUpdate);
                    event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));

                    // $messageUpdate1 =  $userExists1->like_to_be_called  . " We wanted to update you—" . 
                    // $profile->like_to_be_called . " has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.";

                    // $dataUpdate1 = [
                    //     "user_id" => auth()->user()->id, 
                    //     "to_id" =>  $request->feedback_user,     
                    //     "message" => $messageUpdate1,   
                    //     'created_at' => Carbon::now(), 
                    //     'updated_at' => Carbon::now(),
                    // ];
                    
                    // $notification = Notification::create($dataUpdate1);
                    // event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));

                    // if($profile->is_subscribed == 1){
                    //     Mail::to($profile->email)->send(new RejectInvitationMail($profile, $userExists1));
                    // }

                    if($userExists1->is_subscribed == 1){
                        if (!empty($userExists1->local)) {
                            App::setLocale($userExists1->local);
                        }
                        Mail::to($userExists1->email)->send(new RejectInvitationMail($userExists1 ,$profile));
                        App::setLocale(config('app.locale'));
                    }
                        
                    DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->feedback_user)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                    DB::table('user_likes')->where('liked_user_id', auth()->user()->id)->where('user_id', $request->feedback_user)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                    $userExists1->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                    $profile->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                }

                if($dataUpdatedUser->want_to_continue == null){
                    $updated->update(['is_feedback_pending' => 1]);

                    $messageUpdate_feedback =  auth()->user()->like_to_be_called  . " has provided feedback about your date. You will only be able to see it once you submit your own feedback.Keep in mind, completing this step is essential for the platform to continue all processes smoothly.<br> 
                    <a href='/show/feedback'>Submit Feedback</a>";

                    $messageUpdate_spanish_feedback =  auth()->user()->like_to_be_called  . " ha proporcionado comentarios sobre tu cita. Solo podrás verlo una vez que envíes tus propios comentarios. Ten en cuenta que completar este paso es esencial para que la plataforma continúe con todos los procesos sin problemas.<br> 
                    <a href='/show/feedback'>Enviar comentarios</a>";

                    $dataUpdate = [
                        "user_id" => auth()->user()->id, 
                        "to_id" =>  $profile->id,     
                        "message" => $messageUpdate_feedback,
                        "message-spanish" => $messageUpdate_spanish_feedback,
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
                    
                    $notification = Notification::create($dataUpdate);
                    event(new NotificationEvent($profile->id, getUnseenNotification()));
                    if (!empty($profile->local)) {
                        App::setLocale($profile->local);
                    }
                    Mail::to($profile->email)->send(new PendingFeedback($profile, $link));
                    App::setLocale(config('app.locale'));
                } 
            }

            return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_16')]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('controllerText.MeetingController_17'), 'error' => $e->getMessage()]);
        }
    }


    public function commentSubmit(Request $request): JsonResponse
    {

        $request->validate([
            'comments' => 'nullable|string|max:1000',
            'reason_profile0' => 'nullable|string',
            'reason_profile1' => 'nullable|string',
            'reason_description' => 'nullable|string|max:255',
        ]);

        $user_id = auth()->id();

        $visualPicture = $request->filled('visual_picture') ? 1 : 0;
        $reasonProfile0 = $request->filled('reason_profile0') ? 1 : 0;
        $reasonProfile1 = $request->filled('reason_profile1') ? 1 : 0;

        $visualDescription = $request->filled('visual_description') ? 1 : 0;
        $reasonDescription = $visualDescription ? $request->reason_description : null;

        DB::table('user_likes')
            ->where('user_id', $request->comment_user)
            ->where('liked_user_id', $user_id)
            ->update([
                'visualPicture' => $visualPicture,
                'visualDescription' => $visualDescription,
                'reason_profile0' => $reasonProfile0,
                'reason_profile1' => $reasonProfile1,
                'reason_description' => $reasonDescription,
                'comments' => $request->comments,
                'is_connect' => 0,
            ]);
        
        $Users = User::find($user_id);
        $profile = User::find($request->comment_user); 

        $link = route('users.show-user', $profile->id);

        if($profile->is_subscribed == 1){
            if (!empty($profile->local)) {
                App::setLocale($profile->local);
            }
            Mail::to($profile->email)->send(new ReceivedComment($profile->like_to_be_called, $Users->like_to_be_called, $link));
            App::setLocale(config('app.locale'));
        }
        return response()->json(['success' => true, 'message' => __('controllerText.MeetingController_18')]);

    }

    public function showComments()
    {
        $user_id=auth()->user()->id;
        $matchUserId = auth()->user()->match_user_id;
        $matchUserId = is_array($matchUserId) ? $matchUserId : [];

        if (is_array($matchUserId)) {
            $user_like_id = end($matchUserId);
        } else {
            $liked_user_id = $matchUserId; 
        }

        $commentsLast = UserLikes::where('user_id', $user_id)
        ->whereIn('liked_user_id',$matchUserId)
        ->whereNotNull('comments')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        return view('meeting.show_comment', compact('commentsLast'));
    }

    public function showFeedbacks()
    {
        $user_id=auth()->user()->id;
        $matchUserId = auth()->user()->match_user_id;

        if (is_array($matchUserId)) {
            $user_like_id = end($matchUserId);
        } else {
            $user_like_id = $matchUserId; 
        }

        $feedback = Feedback::where('like_user_id', $user_id)
                ->where('user_id', $user_like_id)->first();
        $isPendingFeedback = 0;
        $likedUserName = "";

        if ($feedback) {
            $PendingFeedback = UserLikes::where('liked_user_id', $feedback->user_id)
                ->where('user_id', $feedback->like_user_id)
                ->where('is_feedback_pending', 1)
                ->count();
            $isPendingFeedback = $PendingFeedback;
            $likedUserName = getUserDetails($feedback->user_id)->like_to_be_called ?? '';
        }

        return view('meeting.show_feedback', compact('feedback', 'isPendingFeedback','likedUserName'));
    }
}
