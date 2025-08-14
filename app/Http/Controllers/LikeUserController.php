<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
use App\Models\UserLikes;
use Carbon\Carbon;
use App\Mail\AcceptInvitationMail;
use App\Mail\ReconsiderInvitationMail;
use App\Mail\RejectInvitationMail;
use App\Mail\AuthUserSubmitMeetingMail;
use App\Mail\AcceptUserSubmitMeetingMail;
use App\Mail\MasteringMail1;
use App\Mail\MasteringMail2;
use App\Mail\MasteringConfirmMail;
use App\Mail\BothAcceptInvitation;
use App\Mail\PendingFeedback;
use App\Mail\PendingComments;
use App\Mail\RejectProfileMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;


class LikeUserController extends Controller
{
    public function __invoke(User $user, Request $request)
    {
        
        if ($request->get('liked-user-id')) {
            DB::table('user_likes')->insert([
                ['user_id' => auth()->user()->id, 'liked_user_id' => $request->get('liked-user-id'), 'affection' => 'like'
                ]
            ]);

        } elseif ($request->get('disliked-user-id')) {
            DB::table('user_likes')->insert([
                ['user_id' => auth()->user()->id, 'liked_user_id' => $request->get('disliked-user-id'), 'affection' => 'dislike']
            ]);
        }

        if (auth()->user()->interested_in == 'female') {

            $nextUserID = User::query()->withoutMe()->withoutLiked()->withoutDisliked()->isHidden()->onlyFemale()->ageRange()->min('id');

            if ($nextUserID != null) {
                return redirect()->route('users.show-all', ['user' => $nextUserID]);
            } else {
                return redirect('/show-all')->with('status', __('controllerText.LikeUserController_1'));
            }


        } elseif (auth()->user()->interested_in == 'male') {

            $nextUserID = User::query()->withoutMe()->withoutLiked()->withoutDisliked()->isHidden()->onlyMale()->ageRange()->min('id');

            if ($nextUserID != null) {
                return redirect()->route('users.show-all', ['user' => $nextUserID]);
            } else {
                return redirect('/show-all')->with('status', __('controllerText.LikeUserController_1'));
            }

        } else {

            $nextUserID = User::query()->withoutMe()->withoutLiked()->withoutDisliked()->isHidden()->ageRange()->min('id');

            if ($nextUserID != null) {
                return redirect()->route('users.show-all', ['user' => $nextUserID]);
            } else {
                return redirect('/show-all')->with('status', __('controllerText.LikeUserController_1'));
            }
        }
    }

    public function likeUser(Request $request)
    {
        
        if ($request->liked_user_id) {
            $rrr = DB::table('user_likes')->insert([
                ['user_id' => auth()->user()->id, 'liked_user_id' => $request->liked_user_id, 'affection' => 'like'
                ]
            ]);
            
            $message = auth()->user()->name.' '. "Like your profile.";
            $link = "";

            $data = [
                "user_id" => auth()->user()->id, 
                "to_id" => $request->liked_user_id,     
                "message" => $message,
                "link" => $link,   
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ];
            $notification = Notification::create($data);

            $unseenNotiCount = getUnseenNotification();
            $userId = $request->liked_user_id;
            event(new NotificationEvent($userId, $unseenNotiCount));

            return response()->json(['success' => true]);
        }
    }

    public function dislikeUser(Request $request)
    {
        if ($request->disliked_user_id) {
            DB::table('user_likes')->insert([
                ['user_id' => auth()->user()->id, 'liked_user_id' => $request->disliked_user_id, 'affection' => 'dislike']
            ]);

            $message = auth()->user()->name.' '. "Dislike your profile.";
            $link = "";

            $data = [
                "user_id" => auth()->user()->id, 
                "to_id" =>$request->disliked_user_id,     
                "message" => $message,
                "link" => $link,   
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(),
            ];
            $notification = Notification::create($data);

            $unseenNotiCount = getUnseenNotification();
            $userId = $request->disliked_user_id;
            event(new NotificationEvent($userId, $unseenNotiCount));
            
            return response()->json(['success' => true]);
        }
    }

    public function acecept(Request $request)
    {
        $isChatActivated = false;
        if(auth()->user()->status == "approved" && !activeSubscriptionCheck())
        {
            return response()->json([
                'success' => false,
                'subscription' => true,
                'message' => __('controllerText.LikeUserController_2')
            ]);
        }elseif ($request->accept_user_id) {
            
            $updatedRows = DB::table('user_likes')
                ->where('user_id', auth()->user()->id)
                ->where('liked_user_id', $request->accept_user_id)
                ->update(['affection' => 'accept','updated_at' => Carbon::now()]);

            $updatedRows1 = DB::table('user_likes')
                ->where('user_id', $request->accept_user_id)
                ->where('liked_user_id', auth()->user()->id)
                ->first();

            $updatedRowsGet = DB::table('user_likes')
                ->where('user_id', auth()->user()->id)
                ->where('liked_user_id', $request->accept_user_id)
                ->first();

            if($updatedRows1->affection == "reject" && $updatedRows1->is_connect == 0 && $updatedRowsGet->affection == "accept" && $updatedRowsGet->is_connect == 0){

                $updatedRows1 = DB::table('user_likes')
                ->where('user_id', $request->accept_user_id)
                ->where('liked_user_id', auth()->user()->id)
                ->update(['is_mastering' => 1,'updated_at' => Carbon::now()]);

                $message = '<img src="' . asset('/pictures/mastering-logo-bl.png') . '" style="width:100%; height:auto;  margin-top:10px; margin-bottom:10px;" /> <br>'.ucfirst(auth()->user()->like_to_be_called)." has expressed interest in you! Would you like to reconsider?";
                $message .= '<p onclick="triggerMasteringSwal(' . auth()->user()->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activate Mastering</p> <br>';

                $message_spanish = '<img src="' . asset('/pictures/mastering-logo-bl.png') . '" style="width:100%; height:auto;  margin-top:10px; margin-bottom:10px;" /> <br>'.ucfirst(auth()->user()->like_to_be_called)." ¡ha mostrado interés en ti! ¿Te gustaría reconsiderarlo?";
                $message_spanish .= '<p onclick="triggerMasteringSwal(' . auth()->user()->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activar Mastering</p> <br>';

                $link = route('users.show-user', auth()->user()->id);

                $data = [
                    "user_id" => auth()->user()->id, 
                    "to_id" =>  $request->accept_user_id,     
                    "message" => $message,
                    "message-spanish" => $message_spanish,
                    // "link" => $link,   
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(),
                ];

                $notification = Notification::create($data);
                $acceptUserId = getUserDetails($request->accept_user_id);
                $userDetail = auth()->user();
                if($acceptUserId->is_subscribed == 1){
                    if (!empty($acceptUserId->local)) {
                        App::setLocale($acceptUserId->local);
                    }
                    Mail::to($acceptUserId->email)->send(new ReconsiderInvitationMail($acceptUserId, $userDetail));
                    App::setLocale(config('app.locale'));
                }
            }else{

                if($updatedRows1->affection == "accept" && $updatedRowsGet->affection == "accept"){

                    $acceptUserId = getUserDetails($request->accept_user_id);
                    $userDetail = auth()->user();
                    
                    DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->accept_user_id)->update(['is_connect' => 1,'updated_at' => Carbon::now(),'created_at' => Carbon::now()]);

                    DB::table('user_likes')->where('user_id', $request->accept_user_id)->where('liked_user_id', auth()->user()->id)->update(['is_connect' => 1,'updated_at' => Carbon::now(),'created_at' => Carbon::now()]);

                    $message1 = "It’s Official! You and " . $userDetail->like_to_be_called . " Have Connected";
                    $message_spanish1 = "¡Es oficial! Tú y " . $userDetail->like_to_be_called . " se han conectado";
                    $link1 = route('users.show-user', auth()->user()->id);
        
                    $data1 = [
                        "user_id" => auth()->user()->id, 
                        "to_id" =>  $request->accept_user_id,     
                        "message" => $message1,
                        "message-spanish" => $message_spanish1,
                        "link" => $link1,   
                        'created_at' => Carbon::now()
                    ];
                    $notification = Notification::create($data1);
                    event(new NotificationEvent($request->accept_user_id, getUnseenNotification()));

                    $message2 = "It’s Official! You and " . $acceptUserId->like_to_be_called .  " Have Connected";
                    $message_spanish2 = "¡Es oficial! Tú y " . $acceptUserId->like_to_be_called . " se han conectado";
                    $link2 = route('users.show-user', auth()->user()->id);
        
                    $data2 = [
                        "user_id" => $request->accept_user_id, 
                        "to_id" =>  auth()->user()->id,     
                        "message" => $message2,
                        "message-spanish" => $message_spanish2,
                        "link" => $link2,   
                        'created_at' => Carbon::now()
                    ];
                    $notification = Notification::create($data2);
                    event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));


                    if($acceptUserId->is_subscribed == 1){
                        if($acceptUserId->is_subscribed == 1){
                            if (!empty($acceptUserId->local)) {
                                App::setLocale($acceptUserId->local);
                            }
                            $templateFirst = new BothAcceptInvitation($acceptUserId, $userDetail);
                            Mail::to($acceptUserId->email)->send($templateFirst);
                            App::setLocale(config('app.locale'));
                        }
                    }
    
                    if(auth()->user()->is_subscribed == 1){
                        

                        if($userDetail->is_subscribed == 1){
                            if (!empty($userDetail->local)) {
                                App::setLocale($userDetail->local);
                            }
                            $templateSecond = new BothAcceptInvitation($userDetail, $acceptUserId);
                            Mail::to($userDetail->email)->send($templateSecond);
                            App::setLocale(config('app.locale'));
                        }
                    }
                    $isChatActivated = true;

                }else{
                    $acceptUserId = getUserDetails($request->accept_user_id);
                    $message_move = ucfirst(auth()->user()->like_to_be_called) ." has made a move—now it’s your turn!";
                    $message_spanish_move = ucfirst(auth()->user()->like_to_be_called) ." ¡ha dado el primer paso — ahora te toca a ti!";
                    $link = route('users.show-user', auth()->user()->id);
        
                    $data = [
                        "user_id" => auth()->user()->id, 
                        "to_id" =>  $request->accept_user_id,     
                        "message" => $message_move,
                        "message-spanish" => $message_spanish_move,
                        "link" => $link,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
                    $notification = Notification::create($data);
                    event(new NotificationEvent($request->accept_user_id, getUnseenNotification()));


                    $message_replied = "You’ve made your move. ".ucfirst($acceptUserId->like_to_be_called) ." hasn't replied yet, hang tight!";
                    $message_spanish_replied = "Has dado el primer paso. ".ucfirst($acceptUserId->like_to_be_called) ." aún no ha respondido, ¡ten paciencia!";
                    $link1 = route('users.show-user', auth()->user()->id);
        
                    $data1 = [
                        "user_id" => $request->accept_user_id, 
                        "to_id" =>  auth()->user()->id,     
                        "message" => $message_replied,
                        "message-spanish" => $message_spanish_replied,
                        "link" => $link1,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
                    $notification = Notification::create($data1);
                    event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));

                    $userDetail = auth()->user();

                    if($acceptUserId->is_subscribed == 1){
                        if (!empty($acceptUserId->local)) {
                            App::setLocale($acceptUserId->local);
                        }
                        Mail::to($acceptUserId->email)->send(new AcceptInvitationMail($acceptUserId, $userDetail));
                        App::setLocale(config('app.locale'));
                    }
                }
            }

            $unseenNotiCount = getUnseenNotification();
            $userId = $request->accept_user_id;

            event(new NotificationEvent($userId, $unseenNotiCount));

            $acceptUserDetailsData = getUserDetails($request->accept_user_id)->like_to_be_called ?? '';
            return response()->json(['success' => true, 'nickname'=> $acceptUserDetailsData,'isChatActivated' => $isChatActivated]);
        }
    }

    public function reject(Request $request)
    {
        if ($request->reject_user_id) {

            $updatedRows = DB::table('user_likes')
                ->where('user_id', auth()->user()->id)
                ->where('liked_user_id', $request->reject_user_id)
                ->update(['affection' => 'reject','updated_at' => Carbon::now()]);

            $updatedRows1 = DB::table('user_likes')
                ->where('user_id', $request->reject_user_id)
                ->where('liked_user_id', auth()->user()->id)
                ->first();

            $AFterUpdate = DB::table('user_likes')
                ->where('user_id', auth()->user()->id)
                ->where('liked_user_id', $request->reject_user_id)
                ->first();
                
            $acceptUserData = getUserDetails($request->accept_user_id);
            $authUserData = auth()->user();

            if($updatedRows1->affection == "accept" && $updatedRows1->is_connect == 0 && $AFterUpdate->affection == "reject" && $AFterUpdate->is_connect == 0){

                DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->reject_user_id)
                ->update(['is_mastering' => 1,'updated_at' => Carbon::now()]);

                $acceptUserId = getUserDetails($request->reject_user_id);
                $userDetail = auth()->user();

                $message_accepted = '<img src="' . asset('/pictures/mastering-logo-bl.png') . '" style="width:100%; height:auto;  margin-top:10px; margin-bottom:10px;" /> <br>' 
                            . ucfirst(auth()->user()->like_to_be_called).'you have a one-sided match! <br><br>';
                $message_accepted .= ucfirst($acceptUserId->like_to_be_called)." has said accepted your Invitation, but your response was different.";
                $message_accepted .= "Would you like to reconsider? This could be a great opportunity to improve your feedback rating. <br><br>";
                $message_accepted .= '<p onclick="triggerMasteringSwal(' . $acceptUserId->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activate Mastering</p> <br>';

                $message_spanish_accepted = '<img src="' . asset('/pictures/mastering-logo-bl.png') . '" style="width:100%; height:auto;  margin-top:10px; margin-bottom:10px;" /> <br>' 
                            . ucfirst(auth()->user()->like_to_be_called).'¡tienes una coincidencia unilateral! <br><br>';
                $message_spanish_accepted .= ucfirst($acceptUserId->like_to_be_called)." ha aceptado tu invitación, pero tu respuesta fue diferente.";
                $message_spanish_accepted .= "¿Te gustaría reconsiderarlo? Esta podría ser una gran oportunidad para mejorar tu puntuación de retroalimentación. <br><br>";
                $message_spanish_accepted .= '<p onclick="triggerMasteringSwal(' . $acceptUserId->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activar Mastering</p> <br>';

                $link = route('users.show-user', $acceptUserId->id);

                $data = [
                    "user_id" => $request->reject_user_id, 
                    "to_id" =>  auth()->user()->id,     
                    "message" => $message_accepted,
                    "message-spanish" => $message_spanish_accepted,
                    // "link" => $link,   
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(),
                ];

                $notification = Notification::create($data);
                event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));

                

                if($acceptUserId->is_subscribed == 1){
                    if (!empty($acceptUserId->local)) {
                        App::setLocale($acceptUserId->local);
                    }
                    Mail::to($acceptUserId->email)->send(new MasteringMail1($userDetail, $acceptUserId));
                    App::setLocale(config('app.locale'));
                }

                // if($userDetail->is_subscribed == 1){
                // Mail::to($userDetail->email)->send(new MasteringMail2($userDetail, $acceptUserId));
                // }

            }else{
                if($updatedRows1->affection == "reject" && $AFterUpdate->affection == "reject"){

                    $acceptUserId = getUserDetails($request->accept_user_id);
                    $userDetail = auth()->user();
                    // Mail::to($acceptUserId->email)->send(new BothAcceptInvitation($acceptUserId, $userDetail));
                    $userExists1 = User::find(auth()->user()->id);
                    $profile = User::find($request->reject_user_id);

                    $userExists1->update([
                        // 'last_email_sent_at' => now(),
                        // 'exit_at' => now(),
                        'last_email_sent_at' => Carbon::now()->subDays(3),  //after test chnage this line
                        'exit_at' => Carbon::now()->subDays(3),  //after test chnage this line
                        'is_hidden' => 0
                    ]);

                    $profile->update([
                        // 'last_email_sent_at' => now(),
                        // 'exit_at' => now(),
                        'last_email_sent_at' => Carbon::now()->subDays(3),  //after test chnage this line
                        'exit_at' => Carbon::now()->subDays(3),  //after test chnage this line
                        'is_hidden' => 0
                    ]);

                    DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->reject_user_id)->update([
                        'affection' => 'exit',
                        'updated_at' => Carbon::today()
                    ]);

                    DB::table('user_likes')->where('liked_user_id', auth()->user()->id)->where('user_id', $request->reject_user_id)->update([
                        'affection' => 'exit',
                        'updated_at' => Carbon::today()
                    ]);

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
                        Mail::to($userExists1->email)->send(new RejectInvitationMail($userExists1, $profile));
                        App::setLocale(config('app.locale'));
                    }

                    return response()->json([
                        'success' => true,
                        'message' => '<div class="row" id="data-refresh2">
                            <a href="#" class="item-data-item item-data-comments m-5 pr-2 pl-2" data-item-tooltip="0 Comments">
                                <p class="text-white profile-res w-100" style="margin-top:25rem;">'. __('controllerText.LikeUserController_14').'</p>
                            </a>
                        </div>'
                    ]);

                }else{
                    $acceptUserId = getUserDetails($request->reject_user_id);
                    
                    if($AFterUpdate->affection == "reject" && $AFterUpdate->is_connect == 1){

                        $userExists1 = User::find(auth()->user()->id);
                        $profile = User::find($request->reject_user_id);
                        
                        if ($updatedRows1->comments != null) {
                            $linkComment = '<a href="/show/comment">See Comment</a>';
                            $linkCommentSpanish = '<a href="/show/comment">Ver comentario</a>';
                        } else {
                            $linkComment = '';
                            $linkCommentSpanish ='';
                        }                        

                        DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->reject_user_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                        DB::table('user_likes')->where('liked_user_id', auth()->user()->id)->where('user_id', $request->reject_user_id)->update(['affection' => 'exit','updated_at' => Carbon::today(),'is_connect' =>0]);

                        $message_wantUpdate =  $profile->like_to_be_called  . " We wanted to update you—". 
                        $userExists1->like_to_be_called . " has chosen to explore a different path this time. But don’t worry, The Silverbridge™ is always working behind the scenes to find someone who truly aligns with you.<br>" . $linkComment;

                        $messageSpanish_wantUpdate =  $profile->like_to_be_called  . " Queríamos informarte—" . 
                        $userExists1->like_to_be_called . "ha decidido explorar un camino diferente esta vez. ¡Pero no te preocupes! The Silverbridge™ siempre está trabajando entre bastidores para encontrar a alguien que realmente se alinee contigo.<br>" . $linkCommentSpanish;

                        //$link = route('users.show-user. "', auth()->user()->id);
                        $dataUpdate = [
                            "user_id" => $userExists1->id, 
                            "to_id" =>  $request->reject_user_id,     
                            "message" => $message_wantUpdate,
                            "message-spanish" => $messageSpanish_wantUpdate,
                            // "link" => $link,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                        
                        $notification = Notification::create($dataUpdate);
                        event(new NotificationEvent($request->reject_user_id, getUnseenNotification()));

                         $userDetail = auth()->user();
                        if($acceptUserId->is_subscribed == 1){
                            if (!empty($acceptUserId->local)) {
                                App::setLocale($acceptUserId->local);
                            }
                            Mail::to($acceptUserId->email)->send(new RejectInvitationMail($acceptUserId, $userDetail));
                            App::setLocale(config('app.locale'));
                        }

                        $userExists1->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                        $profile->update(['last_email_sent_at' => now(),'exit_at' => now(),'is_hidden' => 0]);
                    }else{

                        $message_yourTurn = auth()->user()->like_to_be_called  . " has made a move—now it’s your turn! You have up to four days from the affinity announcement to decide.";
                        $message_spanish_yourTurn = auth()->user()->like_to_be_called  . " ¡ha dado el primer paso — ahora te toca a ti! Tienes hasta cuatro días desde el anuncio de afinidad para decidir.";

                        $link = route('users.show-user', auth()->user()->id);
                        $data = [
                            "user_id" => auth()->user()->id, 
                            "to_id" =>  $request->reject_user_id,     
                            "message" => $message_yourTurn,
                            "message-spanish" => $message_spanish_yourTurn,
                            "link" => $link,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
                        
                        $notification = Notification::create($data);
                        event(new NotificationEvent($request->reject_user_id, getUnseenNotification()));


                        $message_waiting = "Just waiting on " . $acceptUserId->like_to_be_called . " to reply.";

                        $message_spanish_waiting = "Sólo esperando a " . $acceptUserId->like_to_be_called . " para responder.";

                        $link1 = route('users.show-user', auth()->user()->id);
    
                        $data1 = [
                            "user_id" =>$request->reject_user_id, 
                            "to_id" =>   auth()->user()->id,     
                            "message" => $message_waiting,
                            "message-spanish" => $message_spanish_waiting,
                            "link" => $link1,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
    
                        Notification::create($data1);
                        event(new NotificationEvent(auth()->user()->id, getUnseenNotification()));

                        $userDetail = auth()->user();
                        if($acceptUserId->is_subscribed == 1){

                            $profilesName = $acceptUserId->like_to_be_called;
                            $userName = auth()->user()->like_to_be_called;
                            $user_id= auth()->user()->id;
                            if (!empty($acceptUserId->local)) {
                                App::setLocale($acceptUserId->local);
                            }
                            Mail::to($acceptUserId->email)->send(new RejectProfileMail($profilesName, $userName, $user_id));
                            App::setLocale(config('app.locale'));
                        }
                    }       
                }
            }

            // $userId = $request->reject_user_id;
            // event(new NotificationEvent($userId, getUnseenNotification()));

            return response()->json(['success' => true, 'message'=> ""]);
        }
    }

    public function mastering(Request $request){
        
        if($request->accept_user_id){

            $isChatActivated = false;

            $updatedRows = DB::table('user_likes')
            ->where('user_id', auth()->user()->id)
            ->where('liked_user_id', $request->accept_user_id);
            
            $updatedRows1 = DB::table('user_likes')
                ->where('user_id', $request->accept_user_id)
                ->where('liked_user_id', auth()->user()->id);

            if($request->status == 0){

                $updatedRowsStatus = $updatedRows->update(['is_mastering' => 2,'updated_at' => Carbon::now()]);

                $updatedRowsafft = $updatedRows->first();
                $affectionData = $updatedRows1->first();
                
                if($affectionData->affection == 'accept' && $affectionData->is_mastering == 0 && $updatedRowsafft->affection == 'reject' && $updatedRowsafft->is_mastering == 2){

                    $updatedRows1->update(['is_mastering' => 1, 'updated_at' => Carbon::now()]);

                    $acceptUserId = getUserDetails($request->accept_user_id);

                    $message_trymastering = auth()->user()->like_to_be_called ." wants to try mastering with you!<br><br>";
                    $message_trymastering .= '<p onclick="triggerMasteringSwal(' . auth()->user()->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activate Mastering</p> <br>';

                    $message_spanish_trymastering = auth()->user()->like_to_be_called . " ¡quiere intentar mastering contigo!<br><br>";
                    $message_spanish_trymastering .= '<p onclick="triggerMasteringSwal(' . auth()->user()->id . ')" style="background-color:#595959;border-color:#595959;color:white;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:14px;text-align:center;text-transform:uppercase;">Activar Mastering</p> <br>';
                    
                    $link = route('users.show-user', $acceptUserId->id);

                    $data = [
                        "user_id" => auth()->user()->id, 
                        "to_id" =>  $acceptUserId->id,     
                        "message" => $message_trymastering,
                        "message-spanish" => $message_spanish_trymastering,
                        // "link" => $link,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];

                    $notification = Notification::create($data);
                    event(new NotificationEvent($acceptUserId->id, getUnseenNotification()));
                    
                    if($acceptUserId->is_subscribed == 1){
                        if (!empty($acceptUserId->local)) {
                            App::setLocale($acceptUserId->local);
                        }
                        $masteringConfirmTemp = new MasteringConfirmMail($acceptUserId, auth()->user());
                        Mail::to($acceptUserId->email)->send($masteringConfirmTemp);
                        App::setLocale(config('app.locale'));

                    }
                }
            }

            if($request->status == 1){
                $updatedRowsStatus = $updatedRows->update([
                    'is_mastering' => 3,
                    'affection' =>'exit'
                ]);
                // $updatedRows1->update([
                //     'reason_profile'=>$request->reasonPicture,
                //     'reason_description'=>$request->reasonDescription,
                //     'comments'=>$request->comments
                // ]);
            }
              
            $likedupdatedRows1 = $updatedRows1->first();
            $AFterUpdate = $updatedRows->first();
            
            DB::table('notifications')
            ->where('user_id', $request->accept_user_id)
            ->where('to_id', auth()->user()->id)
            ->where(function($query) {
                $query->where('message', 'like', '%you have a one-sided match%')
                    ->orWhere('message', 'like', '%wants to try mastering%')
                    ->orWhere('message', 'like','%Would you like to reconsider%');
            })
            ->delete();

            if($AFterUpdate->is_mastering == 3 && $AFterUpdate->affection == "exit" && $likedupdatedRows1->affection == "accept" && $likedupdatedRows1->is_mastering == 0){

                $updatedRowsStatus = $updatedRows->update(['affection' =>'exit','is_connect' => 0,'updated_at' => Carbon::now()]);
                $updatedRowsStatus = $updatedRows1->update(['affection' =>'exit','is_connect' => 0,'updated_at' => Carbon::now()]);

                $userExists1 = User::find($request->accept_user_id);
                $profile = User::find(auth()->user()->id);

                $userExists1->update([
                    'last_email_sent_at' => now(),
                    'exit_at' => now(),
                    'is_hidden' => 0
                ]);

                $profile->update([
                    'last_email_sent_at' => now(),
                    'exit_at' => now(),
                    'is_hidden' => 0
                ]);

                // $nextMatchProfile = DB::table('user_matches')->where('user_id', $request->accept_user_id)->first();

                if($userExists1->is_subscribed == 1){
                    if (!empty($userExists1->local)) {
                        App::setLocale($userExists1->local);
                    }
                    Mail::to($userExists1->email)->send(new RejectInvitationMail($userExists1, $profile));
                    App::setLocale(config('app.locale'));
                }

                DB::table('notifications')
                ->where('user_id', $request->accept_user_id)
                ->where('to_id', auth()->user()->id)
                ->where(function($query) {
                    $query->where('message', 'like', '%you have a one-sided match%')
                        ->orWhere('message', 'like', '%wants to try mastering%')
                        ->orWhere('message', 'like','%Would you like to reconsider%');
                })
                ->delete();

                DB::table('notifications')
                ->where('user_id', auth()->user()->id)
                ->where('to_id', $request->accept_user_id)
                ->where(function($query) {
                    $query->where('message', 'like', '%you have a one-sided match%')
                        ->orWhere('message', 'like', '%wants to try mastering%')
                        ->orWhere('message', 'like','%Would you like to reconsider%');
                })
                ->delete();

            }

            if(($likedupdatedRows1->is_mastering == 2 && $AFterUpdate->is_mastering == 3) || ($likedupdatedRows1->is_mastering == 3 && $AFterUpdate->is_mastering == 2)){

                $updatedRowsStatus = $updatedRows->update(['affection' =>'exit','is_connect' => 0,'updated_at' => Carbon::now()]);
                $updatedRowsStatus = $updatedRows1->update(['affection' =>'exit','is_connect' => 0,'updated_at' => Carbon::now()]);

                $userExists1 = User::find($request->accept_user_id);
                $profile = User::find(auth()->user()->id);

                $userExists1->update([
                    'last_email_sent_at' => now(),
                    'exit_at' => now(),
                    'is_hidden' => 0
                ]);

                $profile->update([
                    'last_email_sent_at' => now(),
                    'exit_at' => now(),
                    'is_hidden' => 0
                ]);

            }

            if($likedupdatedRows1->is_mastering == 2 && $AFterUpdate->is_mastering == 2){

                $updatedRowsStatus = $updatedRows->update(['affection' =>'accept','is_connect' => 1,'is_mastering' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                $updatedRowsStatus = $updatedRows1->update(['affection' =>'accept','is_connect' => 1,'is_mastering' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

                
                $userDetail = auth()->user();
                $acceptUserId = getUserDetails($request->accept_user_id);


                $message_official = "It’s Official! You and ". $acceptUserId->like_to_be_called ." Have Connected";
                $message_spanish_official = "¡Es oficial! Tú y ". $acceptUserId->like_to_be_called ." se han conectado";
                $link = route('users.show-user', $acceptUserId->id);

                $data = [
                    "user_id" => $acceptUserId->id, 
                    "to_id" =>  $userDetail->id,     
                    "message" => $message_official,
                    "message-spanish" => $message_spanish_official,
                    "link" => $link,   
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(),
                ];
                $notification = Notification::create($data);
                event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                $message_official1 = "It’s Official! You and ". $userDetail->like_to_be_called ." Have Connected";
                $message_spanish_official1 = "¡Es oficial! Tú y ". $userDetail->like_to_be_called ." se han conectado";
                $link1 = route('users.show-user',  $userDetail->id);

                $data1 = [
                    "user_id" => $userDetail->id, 
                    "to_id" =>  $acceptUserId->id,     
                    "message" => $message_official1,
                    "message-spanish" => $message_spanish_official1,
                    "link" => $link1,   
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(),
                ];
                $notification = Notification::create($data1);
                event(new NotificationEvent($acceptUserId->id, getUnseenNotification()));


                if($acceptUserId->is_subscribed == 1){
                     if (!empty($acceptUserId->local)) {
                        App::setLocale($acceptUserId->local);
                    }
                    $templateFirst = new BothAcceptInvitation($acceptUserId, $userDetail);
                    Mail::to($acceptUserId->email)->send($templateFirst);
                    App::setLocale(config('app.locale'));
                }

                if(auth()->user()->is_subscribed == 1){
                    if (!empty($userDetail->local)) {
                        App::setLocale($userDetail->local);
                    }
                    $templateSecond = new BothAcceptInvitation($userDetail, $acceptUserId);
                    Mail::to($userDetail->email)->send($templateSecond);
                    App::setLocale(config('app.locale'));
                }

                $isChatActivated = true;
            }
            
            return response()->json(['success' => true, 'isChatActivated' => $isChatActivated]);
        }
    }

    public function masteringActivationCheck(Request $request){
        $IsCommentDone = false;
        if ($request->user_id) {
            $exists = DB::table('user_likes')
                ->where('user_id', auth()->id()) 
                ->where('liked_user_id', $request->user_id)
                ->where('is_mastering', 1)
                ->exists();

            $secondMatchData2 = getMatchProfileStatus($request->user_id)['secondEmailMatch'] ?? null;
            if($secondMatchData2 && $secondMatchData2->visualPicture == 1 || $secondMatchData2->visualDescription == 1 || $secondMatchData2->comments != ""){
                $IsCommentDone = true;
            }
            return response()->json(['success' => $exists, 'IsCommentDone' =>$IsCommentDone]);
        }
        return response()->json(['success' => false, 'IsCommentDone' =>$IsCommentDone]);
    }
    
    public function publishComment(Request $request){
        $updated = DB::table('feedback')
            ->where('user_id', $request->user_id)
            ->where('like_user_id', $request->liked_user_id)
            ->where('id', $request->comment_id)
            ->update(['is_publish_comments' => $request->status]);

        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    
    public function profilePreview(Request $request){
        if($request->id != '' || $request->id != null){
            $result = DB::table('user_likes')->where('user_id', auth()->user()->id)->where('liked_user_id', $request->id)
            ->update(['is_profile_view' => 1]);
            return response()->json(['success' => true]);
        } 
    }

    public function getChatActivation(): JsonResponse
    {
        $userId = auth()->id();

        $emailMatch = UserLikes::where('user_id', $userId)
                        ->where('affection', 'accept')
                        ->pluck('liked_user_id');

        $emailMatchReturn = UserLikes::where('liked_user_id', $userId)
                                ->where('affection', 'accept')
                                ->pluck('user_id');

        if ($emailMatch->isNotEmpty() && $emailMatchReturn->isNotEmpty()) {
            $matches = User::whereIn('id', $emailMatch)
                        ->where('is_hidden', 1)
                        ->first();

            if ($matches) {
                return response()->json(['inviteUser' => $matches->id]);
            }
        }

        return response()->json(['inviteUser' => 0]);
    }
}
