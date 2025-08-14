<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\UserLikes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Models\AdminNotification;
use App\Models\Feedback;

use App\Mail\MembershipCourtesyMail;
use App\Mail\MembershipExpireMail;
use App\Mail\ProfileManualReviewMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;

class CheckSubscriptionEndDate extends Command
{
    protected $signature = 'subscription:check-end-date';
    protected $description = 'Check subscriptions expiry';

    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $subscriptions = Subscription::whereDate('end_date', '<', $today)->where('status', 'active')->get();
    
        if ($subscriptions->isNotEmpty()) {
            foreach ($subscriptions as $subscription) {
                $userDetail = getUserDetails($subscription->user_id);

                $Matchcount = ($userDetail->match_user_id)?count($userDetail->match_user_id):0;
                
                if($Matchcount < 7){
                    $newDate = Carbon::parse($subscription->end_date)->addMonths(2);
                    $renew = 1;
                    $subscription->update(['status' => 'active','end_date' => $newDate,'renew_status' =>$renew]);

                    $messageData = __('controllerText.CheckSubscriptionEndDate_1')." 🎉 ". __('controllerText.CheckSubscriptionEndDate_2');

                    $messageData_emglish = "Congratulations! 🎉  You have received a membership courtesy for two month. Enjoy the benefits! Thank you for being a valued member.";

                    $messageData_spanish = "¡Felicidades! 🎉  Has recibido una cortesía de membresía por dos meses. ¡Disfruta de los beneficios! Gracias por ser un miembro valioso.";

                    $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                    $messageUpdateYou3 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;

                    $message_spanish_UpdateYou3 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                    $link = route('user.subscription.index');
                    $data = [
                        "user_id" => $userDetail->id, 
                        "to_id" =>  $userDetail->id,     
                        "message" => $messageUpdateYou3,
                        "message-spanish" => $message_spanish_UpdateYou3,
                        "link" => $link,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
        
                    $ddds = Notification::create($data);
                    event(new NotificationEvent($userDetail->id, getUnseenNotification()));
                    $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                    // sendWhatsAppMessage($phoneNumber, $message);
                    sendTelerivetSms($phoneNumber, $message);

                    if($userDetail->is_subscribed == 1){
                        if (!empty($userDetail->local)) {
                            App::setLocale($userDetail->local);
                        }
                        Mail::to($userDetail->email)->send(new MembershipCourtesyMail($userDetail, $link, $messageData));
                        App::setLocale(config('app.locale'));
                    }
                }elseif($Matchcount == 7){
                    
                    $CheckMatch = UserLikes::where('meeting_status',0)->where('follow_up_status',0)->where('user_id',$subscription->user_id)->whereIn('liked_user_id',$userDetail->match_user_id)->count();
                
                    if($Matchcount == $CheckMatch){
                        $newDate = Carbon::parse($subscription->end_date)->addMonths(2);
                        $renew = 1;
                        $subscription->update(['status' => 'active','end_date' => $newDate,'renew_status' =>$renew]);
                        
                        $messageData = __('controllerText.CheckSubscriptionEndDate_1')." 🎉 ".__('controllerText.CheckSubscriptionEndDate_2');

                        $messageData_emglish = "Congratulations! 🎉  You have received a membership courtesy for two month. Enjoy the benefits! Thank you for being a valued member.";

                        $messageData_spanish = "¡Felicidades! 🎉  Has recibido una cortesía de membresía por dos meses. ¡Disfruta de los beneficios! Gracias por ser un miembro valioso.";

                        $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                        $messageUpdateYou3 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;

                        $message_spanish_UpdateYou3 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                        $link = route('user.subscription.index');
                        $data = [
                            "user_id" => $userDetail->id, 
                            "to_id" =>  $userDetail->id,     
                            "message" => $messageUpdateYou3,
                            "message-spanish" => $message_spanish_UpdateYou3,
                            "link" => $link,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
            
                        $ddds = Notification::create($data);
                        event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                        $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                        // sendWhatsAppMessage($phoneNumber, $message);
                        sendTelerivetSms($phoneNumber, $message);
                        if($userDetail->is_subscribed == 1){
                            if (!empty($userDetail->local)) {
                                App::setLocale($userDetail->local);
                            }
                            Mail::to($userDetail->email)->send(new MembershipCourtesyMail($userDetail, $link, $messageData));
                            App::setLocale(config('app.locale'));
                        }
                    }else{
                        if($Matchcount > $CheckMatch){
                            $feedbackData = getUserFeedback($subscription->user_id);
                            
                            if($feedbackData['feedbackTotalAverage'] >= 3){
                                if($userDetail->interested_in =="Female"){
                                    $newDate = Carbon::parse($subscription->end_date)->addMonths(6);
                                    $renew = 1;
                                    $subscription->update(['status' => 'active','end_date' => $newDate,'renew_status' =>$renew]);

                                    $messageData = __('controllerText.CheckSubscriptionEndDate_1')." 🎉 ".__('controllerText.CheckSubscriptionEndDate_3');

                                    $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                                    $messageData_emglish = "Congratulations! 🎉  You have received a membership courtesy for six month. Enjoy the benefits! Thank you for being a valued member.";

                                    $messageData_spanish = "¡Felicidades! 🎉  Has recibido una cortesía de membresía por seis meses. ¡Disfruta de los beneficios! Gracias por ser un miembro valioso.";

                                    $messageUpdateYou4 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;

                                    $message_spanish_UpdateYou4 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                                    $link = route('user.subscription.index');
                                    $data = [
                                        "user_id" => $userDetail->id, 
                                        "to_id" =>  $userDetail->id,     
                                        "message" => $messageUpdateYou4,
                                        "message-spanish" => $message_spanish_UpdateYou4,
                                        "link" => $link,   
                                        'created_at' => Carbon::now(), 
                                        'updated_at' => Carbon::now(),
                                    ];

                                    $ddds = Notification::create($data);
                                    event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                                    $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                                    sendWhatsAppMessage($phoneNumber, $message);
                                    sendTelerivetSms($phoneNumber, $message);
                                    if($userDetail->is_subscribed == 1){
                                        if (!empty($userDetail->local)) {
                                            App::setLocale($userDetail->local);
                                        }
                                        Mail::to($userDetail->email)->send(new MembershipCourtesyMail($userDetail, $link, $messageData));
                                        App::setLocale(config('app.locale'));
                                    }

                                }else{
                                    $subscription->update(['status' => 'expired','is_renew' => 1,'renew_status' =>2]);

                                    $messageData = __('controllerText.CheckSubscriptionEndDate_4');
                                    $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                                    $messageData_emglish = "We noticed that your The Silverbridge™ membership has ended, and while we’re sad to see you go, we want to thank you for being part of our exclusive community.";

                                    $messageData_spanish = "Hemos notado que tu membresía de The Silverbridge™ ha finalizado, y aunque nos entristece verte partir, queremos agradecerte por ser parte de nuestra comunidad exclusiva.";

                                    $messageUpdateYou5 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;
                                    $message_spanish_UpdateYou5 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                                    $link = route('user.subscription.index');
                                    $data = [
                                        "user_id" => $userDetail->id, 
                                        "to_id" =>  $userDetail->id,     
                                        "message" => $messageUpdateYou5,
                                        "message-spanish" => $message_spanish_UpdateYou5,
                                        "link" => $link,   
                                        'created_at' => Carbon::now(), 
                                        'updated_at' => Carbon::now(),
                                    ];

                                    $ddds = Notification::create($data);
                                    event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                                    $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                                    sendWhatsAppMessage($phoneNumber, $message);
                                    sendTelerivetSms($phoneNumber, $message);
                                    if($userDetail->is_subscribed == 1){
                                        if (!empty($userDetail->local)) {
                                            App::setLocale($userDetail->local);
                                        }
                                        Mail::to($userDetail->email)->send(new MembershipExpireMail($userDetail, $link, $messageData));
                                        App::setLocale(config('app.locale'));
                                    }
                                }
                            }else{
                                $subscription->update(['status' => 'expired','renew_status' =>2]);

                                $messageData = __('controllerText.CheckSubscriptionEndDate_4');
                                $message = ucfirst($userDetail->like_to_be_called) ." ".  $messageData;

                                $messageData_emglish = "We noticed that your The Silverbridge™ membership has ended, and while we’re sad to see you go, we want to thank you for being part of our exclusive community.";

                                $messageData_spanish = "Hemos notado que tu membresía de The Silverbridge™ ha finalizado, y aunque nos entristece verte partir, queremos agradecerte por ser parte de nuestra comunidad exclusiva.";

                                $messageUpdateYou5 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;
                                $message_spanish_UpdateYou5 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                                $link = route('user.subscription.index');
                                $data = [
                                    "user_id" => $userDetail->id, 
                                    "to_id" =>  $userDetail->id,     
                                    "message" => $messageUpdateYou5,
                                    "message-spanish" => $message_spanish_UpdateYou5,
                                    "link" => $link,   
                                    'created_at' => Carbon::now(), 
                                    'updated_at' => Carbon::now(),
                                ];

                                $ddds = Notification::create($data);
                                event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                                $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                                sendWhatsAppMessage($phoneNumber, $message);
                                sendTelerivetSms($phoneNumber, $message);
                                if($userDetail->is_subscribed == 1){
                                    if (!empty($userDetail->local)) {
                                        App::setLocale($userDetail->local);
                                    }
                                    Mail::to($userDetail->email)->send(new MembershipExpireMail($userDetail, $link, $messageData));
                                    App::setLocale(config('app.locale'));
                                }

                                $messageData1 =__('controllerText.CheckSubscriptionEndDate_5');
                                $message1 = ucfirst($userDetail->like_to_be_called) ." ". $messageData1;

                                $messageData_emglish = "profile requires manual review. Please review profile and decide whether to activate renewal or permanently block.";

                                $messageData_spanish = "El perfil requiere revisión manual. Por favor, revisa el perfil y decide si activar la renovación o bloquear permanentemente.";

                                $messageUpdateYou6 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;
                                $message_spanish_UpdateYou6 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                                $link1 = url("admin/user-list/view-user/{$userDetail->id}#feedback-section");
                            
                                $userAdminId = 1;
                                $userAdminEmail = "admin@gmail.com";
                                $data = [
                                    "admin_id" =>1, 
                                    "user_id" => $userDetail->id, 
                                    "to_id" =>  0,     
                                    "message" => $messageUpdateYou6,
                                    "message-spanish" => $message_spanish_UpdateYou6,
                                    "link" => $link1,   
                                    'created_at' => Carbon::now(), 
                                    'updated_at' => Carbon::now(),
                                ];
                                $userAdminEmail = "admin@gmail.com";
                                $ddds = AdminNotification::create($data);
                                event(new NotificationEvent($userAdminId, getAdminUnseenNotification())); 
                                Mail::to($userAdminEmail)->send(new ProfileManualReviewMail($userDetail, $link1, $messageData1));
                            }
                        }else{
                            $subscription->update(['status' => 'expired','renew_status' =>2]);

                            $messageData =__('controllerText.CheckSubscriptionEndDate_4');
                            $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                            $messageData_emglish = "We noticed that your The Silverbridge™ membership has ended, and while we’re sad to see you go, we want to thank you for being part of our exclusive community.";

                            $messageData_spanish = "Hemos notado que tu membresía de The Silverbridge™ ha finalizado, y aunque nos entristece verte partir, queremos agradecerte por ser parte de nuestra comunidad exclusiva.";

                            $messageUpdateYou7 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;
                            $message_spanish_UpdateYou7 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;

                            $link = route('user.subscription.index');
                            $data = [
                                "user_id" => $userDetail->id, 
                                "to_id" =>  $userDetail->id,     
                                "message" => $messageUpdateYou7,
                                "message-spanish" => $message_spanish_UpdateYou7,
                                "link" => $link,   
                                'created_at' => Carbon::now(), 
                                'updated_at' => Carbon::now(),
                            ];
                            $ddds = Notification::create($data);
                            event(new NotificationEvent($userDetail->id, getUnseenNotification())); 
        
                            $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                            sendWhatsAppMessage($phoneNumber, $message);
                            sendTelerivetSms($phoneNumber, $message);
                            if($userDetail->is_subscribed == 1){
                                if (!empty($userDetail->local)) {
                                    App::setLocale($userDetail->local);
                                }
                                Mail::to($userDetail->email)->send(new MembershipExpireMail($userDetail, $link, $messageData));
                                App::setLocale(config('app.locale'));
                            }
                        }
                    }
                }else{
                    $subscription->update(['status' => 'expired','renew_status' =>2]);
                    $messageData=__('controllerText.CheckSubscriptionEndDate_4');
                    $message = ucfirst($userDetail->like_to_be_called) ." ". $messageData;

                    $messageData_emglish = "We noticed that your The Silverbridge™ membership has ended, and while we’re sad to see you go, we want to thank you for being part of our exclusive community.";

                    $messageData_spanish = "Hemos notado que tu membresía de The Silverbridge™ ha finalizado, y aunque nos entristece verte partir, queremos agradecerte por ser parte de nuestra comunidad exclusiva.";

                    $messageUpdateYou8 = ucfirst($userDetail->like_to_be_called) ." ". $messageData_emglish;
                    $message_spanish_UpdateYou8 =ucfirst($userDetail->like_to_be_called) ." ". $messageData_spanish ;


                    $link = route('user.subscription.index');
                    $data = [
                        "user_id" => $userDetail->id, 
                        "to_id" =>  $userDetail->id,     
                        "message" => $messageUpdateYou8,
                        "message-spanish" => $message_spanish_UpdateYou8,
                        "link" => $link,   
                        'created_at' => Carbon::now(), 
                        'updated_at' => Carbon::now(),
                    ];
        
                    $ddds = Notification::create($data);
                    event(new NotificationEvent($userDetail->id, getUnseenNotification()));

                    $phoneNumber = '+' . $userDetail->dialCode . $userDetail->phone;
                    sendWhatsAppMessage($phoneNumber, $message);
                    sendTelerivetSms($phoneNumber, $message);
                    if($userDetail->is_subscribed == 1){
                        if (!empty($userDetail->local)) {
                            App::setLocale($userDetail->local);
                        }
                        Mail::to($userDetail->email)->send(new MembershipExpireMail($userDetail, $link, $messageData));
                        App::setLocale(config('app.locale'));
                    }
                }
            }
        }
    }
}
