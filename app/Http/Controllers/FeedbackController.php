<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\MeetingResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLikes;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Mail\RejectProfileMail;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
use App\Mail\RejectInvitationMail;
use Illuminate\Support\Facades\App;


class FeedbackController extends Controller
{
    public function index()
    {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        $user_like_id = auth()->user()->likeUserData()->first();
        $feedback = Feedback::where('meeting_id',$meeting_user_id)->first();

        return view('feedback.create',compact('feedback'));
    }

    
    public function store(Request $request): JsonResponse
    {
                    
        $request->validate([
            'manners' => 'required|integer|between:1,5',
            'photogenic' => 'required|integer|between:1,5',
            'expressiveness' => 'required|integer|between:1,5',
            'opinions_ideas' => 'required|integer|between:1,5',
            'energy' => 'required|integer|between:1,5',
            'willingness' => 'required|integer|between:1,5',
            'attention' => 'required|integer|between:1,5',
            'sense_humer' => 'required|integer|between:1,5',
            'serious_relationship' => 'required',
            'not_connect' => 'nullable|string',
            'connect_person' => 'nullable|string',
            'compliment' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);
        try {

            $user_id=auth()->user()->id;
            $matchUserId = auth()->user()->match_user_id;

            if (is_array($matchUserId)) {
                $user_like_id = end($matchUserId);
            } else {
                $user_like_id = $matchUserId; 
            }
            $feedback=[];
        
            $feedbacks = Feedback::where('id', $request->feedbackId)
                        ->where('user_id', $user_id)
                        ->where('like_user_id', $user_like_id)
                        ->first();

            if($feedbacks){
                $respones= $feedbacks->update([
                    'like_user_id' => $user_like_id->liked_user_id,
                    'manners' => $request->manners,
                    'photogenic' => $request->photogenic,
                    'expressiveness' => $request->expressiveness,
                    'opinions_ideas' => $request->opinions_ideas,
                    'energy' => $request->energy,
                    'attention' => $request->attention,
                    'sense_humer' => $request->sense_humer,
                    // 'comfortable_environment' => $request->comfortable_environment,
                    'serious_relationship' => $request->serious_relationship,
                    'not_connect' => $request->not_connect ?? null,
                    'connect_person' => $request->connect_person ?? null,
                    'compliment' => $request->compliment,
                    'willingness' => $request->willingness,
                    // 'approximateduration' => $request->approximateduration,
                    // 'comments' => $request->comments,
                ]);
            }else{
                $MeetingResponse = MeetingResponse::where('user_id', $user_id)->where('user_like_id', $user_like_id)->where('already_meet', 'yes')->where('continue_meet', 'yes')->orwhere('continue_meet', 'no')->first();

                if($MeetingResponse){
                    $meeting_id=$MeetingResponse->id;
                    $continue_meet  = $MeetingResponse->continue_meet;
                }else{
                    $meeting_id=0;
                    $continue_meet  = null;
                }

                $respones=Feedback::create([
                    'meeting_id' => $meeting_id,
                    'user_id' => $user_id,
                    'like_user_id' => $user_like_id,
                    'manners' => $request->manners,
                    'photogenic' => $request->photogenic,
                    'expressiveness' => $request->expressiveness,
                    'opinions_ideas' => $request->opinions_ideas,
                    'energy' => $request->energy,
                    'attention' => $request->attention,
                    'sense_humer' => $request->sense_humer,
                    // 'comfortable_environment' => $request->comfortable_environment,
                    'serious_relationship' => $request->serious_relationship,
                    'not_connect' => $request->not_connect,
                    'connect_person' => $request->connect_person,
                    'compliment' => $request->compliment,
                    'willingness' => $request->willingness,
                    // 'approximateduration' => $request->approximateduration,
                    // 'comments' => $request->comments,
                ]);
            }

            if($respones)
            {
                $updatedRows = DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $user_like_id)->first();

                $updatedRows1 = DB::table('user_likes')->where('user_id', $user_like_id)->where('liked_user_id', auth()->user()->id)->first();

                if($request->serious_relationship =="No"){
                   
                    if($updatedRows1->want_to_continue =="Yes"){
                        $userExists1 = User::find($user_id);
                        $profile = User::find($user_like_id);
 
                        $messageUpdateYou =  $profile->like_to_be_called  . ' We wanted to update you— ' . $userExists1->like_to_be_called . ' has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.';

                        $message_spanish_UpdateYou =  $profile->like_to_be_called  . ' Queríamos informarte—' . $userExists1->like_to_be_called . ' ha decidido explorar un camino diferente esta vez. ¡Pero no te preocupes! The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.';

                        $dataUpdate = [
                            "user_id" => $updatedRows1->liked_user_id, 
                            "to_id" =>  $updatedRows1->user_id,     
                            "message" => $messageUpdateYou, 
                            "message-spanish" => $message_spanish_UpdateYou,  
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                       
                        $notification = Notification::create($dataUpdate);
                        event(new NotificationEvent($updatedRows1->liked_user_id, getUnseenNotification()));

                        $messageUpdateYou1 = $userExists1->like_to_be_called . ' We wanted to update you—  ' . $profile->like_to_be_called . ' has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.';

                        $message_spanish_UpdateYou1 = $userExists1->like_to_be_called . ' Queríamos informarte—' . $profile->like_to_be_called . ' ha decidido explorar un camino diferente esta vez. ¡Pero no te preocupes! The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.';

                        $dataUpdate1 = [
                            "user_id" => $updatedRows1->user_id, 
                            "to_id" =>  $updatedRows1->liked_user_id,     
                            "message" => $messageUpdateYou1,  
                            "message-spanish" => $message_spanish_UpdateYou1,  
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                        
                        $notification = Notification::create($dataUpdate1);
                        event(new NotificationEvent($updatedRows1->user_id, getUnseenNotification()));

                        if($profile->is_subscribed == 1){
                            if (!empty($profile->local)) {
                                App::setLocale($profile->local);
                            }
                            Mail::to($profile->email)->send(new RejectInvitationMail($profile, $userExists1));
                            App::setLocale(config('app.locale'));
                        }

                        if($userExists1->is_subscribed == 1){
                            if (!empty($userExists1->local)) {
                                App::setLocale($userExists1->local);
                            }
                            Mail::to($userExists1->email)->send(new RejectInvitationMail($userExists1 ,$profile));
                            App::setLocale(config('app.locale'));
                        }

                        DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $user_like_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' => 0,'is_feedback_pending' =>0,'want_to_continue' => $request->serious_relationship]);

                        DB::table('user_likes')->where('liked_user_id', auth()->user()->id)->where('user_id', $user_like_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                        $userExists1->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                        $profile->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);

                    }else{
                        $updatedRows = DB::table('user_likes')
                        ->where('user_id', $user_id)
                        ->where('liked_user_id', $user_like_id)
                        ->update(['is_connect' => 0,'is_feedback_pending' =>0,'want_to_continue' => $request->serious_relationship]);
                    }

                }else{
                    if($request->serious_relationship=="Yes" && $updatedRows1->want_to_continue =="No"){
                        $userExists1 = User::find($user_id);
                        $profile = User::find($user_like_id);

                    
                        $messageUpdateYou2 = $profile->like_to_be_called . ' We wanted to update you—  ' . $userExists1->like_to_be_called . ' has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.';

                        $message_spanish_UpdateYou2 =$profile->like_to_be_called . ' Queríamos informarte—' . $userExists1->like_to_be_called . ' ha decidido explorar un camino diferente esta vez. ¡Pero no te preocupes! The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.';

                        $dataUpdate = [
                            "user_id" => $updatedRows1->liked_user_id, 
                            "to_id" =>  $updatedRows1->user_id,     
                            "message" => $messageUpdateYou2, 
                            "message-spanish" => $message_spanish_UpdateYou2,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                        
                        $notification = Notification::create($dataUpdate);
                        event(new NotificationEvent($updatedRows1->liked_user_id, getUnseenNotification()));

                        $messageUpdateYou3 = $profile->like_to_be_called . ' We wanted to update you—  ' . $userExists1->like_to_be_called . ' has chosen to explore a different path this time.But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.';

                        $message_spanish_UpdateYou3 =$profile->like_to_be_called . ' Queríamos informarte—' . $userExists1->like_to_be_called . ' ha decidido explorar un camino diferente esta vez. ¡Pero no te preocupes! The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.';


                        $dataUpdate1 = [
                            "user_id" => $updatedRows1->user_id, 
                            "to_id" =>  $updatedRows1->liked_user_id,     
                            "message" => $messageUpdateYou3,  
                            "message-spanish" => $message_spanish_UpdateYou3, 
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                        
                        $notification = Notification::create($dataUpdate1);
                        event(new NotificationEvent($updatedRows1->user_id, getUnseenNotification()));

                        if($profile->is_subscribed == 1){
                            if (!empty($profile->local)) {
                                App::setLocale($profile->local);
                            }
                            Mail::to($profile->email)->send(new RejectInvitationMail($profile, $userExists1));
                            App::setLocale(config('app.locale'));
                        }

                        if($userExists1->is_subscribed == 1){
                            if (!empty($userExists1->local)) {
                                App::setLocale($userExists1->local);
                            }
                            Mail::to($userExists1->email)->send(new RejectInvitationMail($userExists1,$profile));
                            App::setLocale(config('app.locale'));
                        }

                        DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $user_like_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' => 0,'is_feedback_pending' =>0,'want_to_continue' => $request->serious_relationship]);

                        DB::table('user_likes')->where('liked_user_id', auth()->user()->id)->where('user_id', $user_like_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                        $userExists1->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                        $profile->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                    }else{
                        $updatedRows = DB::table('user_likes')
                        ->where('user_id', $user_id)
                        ->where('liked_user_id', $user_like_id)
                        ->update(['is_feedback_pending' =>0,'want_to_continue' => $request->serious_relationship]);
                    }
                }

                return response()->json(['success' => true, 'message' => __('controllerText.FeedbackController_3'),'continue_meet' =>  $continue_meet]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('controllerText.FeedbackController_4'), 'error' => $e->getMessage()]);
        }
    }
}