<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileReminderMail;
use Carbon\Carbon;
use App\Models\ChMessage as Message;


use App\Models\AdminNotification;
use App\Models\Feedback;
use App\Events\NotificationEvent;
use App\Mail\ProfileManualReviewMail;
use App\Mail\SendVerifyEmail;
use App\Mail\PaymentReminderEmail;
use App\Mail\ExpireReminderEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use App\Models\Subscription;

class SendReminderEmails extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send reminders every 3 days to users missing corporate email or required documents';

    public function handle()
    {
        
        $users = User::whereNull('verificationOption')
                     ->where(function ($query) {
                         $query->whereNull('last_reminder')
                               ->orWhere('last_reminder', '<=', Carbon::now()->subDays(3));
                     })
                     ->whereNotNull('you_laugh')
                     ->get();

        if($users->isNotEmpty()) {
            foreach ($users as $user) {
                if($user->is_subscribed == 1){
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new ProfileReminderMail($user));
                    App::setLocale(config('app.locale'));
                }
                $user->update(['last_reminder' => Carbon::now()]);
            }
        }

        $users = User::where('verificationOption', 'email')
                     ->where(function ($query) {
                         $query->whereNull('last_Verify_reminder')
                               ->orWhere('last_Verify_reminder', '<', Carbon::now()->subDays(3));
                     })
                     ->where('corporate_email_status',0)
                     ->get();

        if($users->isNotEmpty()) {
            foreach ($users as $user) {
                if($user->is_subscribed == 1){
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->corporateEmail)->send(new SendVerifyEmail($user));
                    App::setLocale(config('app.locale'));
                }
                $user->update(['last_Verify_reminder' => Carbon::now()]);
            }
        }
        

        $users = User::with('subscriptions')->where('status', 'approved')
            ->whereDate('created_at', '>=', Carbon::now()->subMonth())
            ->where(function ($query) {
                $query->whereNull('last_pay_reminder')
                    ->orWhere('last_pay_reminder', '<', Carbon::now()->subDays(7));
                })
                ->whereDoesntHave('subscriptions')
            ->get(); 
           
          
         if($users->isNotEmpty()) {
            foreach ($users as $user) {
                if($user->is_subscribed == 1){
                    $link = route('payment.paymentnow');
                    if (!empty($user->local)) {
                        App::setLocale($user->local);
                    }
                    Mail::to($user->email)->send(new PaymentReminderEmail($user, $link));
                    App::setLocale(config('app.locale'));
                }
                $user->update(['last_pay_reminder' => Carbon::now()]);
            }
        }

        $feedbacks = Feedback::where('is_approved', 0)->where('is_admin_review', 0)->get();

        if($feedbacks->isNotEmpty()) {
            foreach($feedbacks as $feedback){
            
                $feedbackAverages = [
                    'photogenic_avg' => (int) $feedback->photogenic,
                    'expressiveness_avg' => (int) $feedback->expressiveness,
                    'manners_avg' => (int) $feedback->manners,
                    'opinions_ideas_avg' => (int) $feedback->opinions_ideas,
                    'sense_humer_avg' => (int) $feedback->sense_humer,
                    'energy_avg' => (int) $feedback->energy,
                    'willingness_avg' => (int) $feedback->willingness,
                ];

                $feedbackCount = count($feedbackAverages) ?? 1;
                
                $feedbackTotalAverage = (int) round(
                    ($feedbackAverages['photogenic_avg'] + 
                    $feedbackAverages['expressiveness_avg'] + 
                    $feedbackAverages['manners_avg'] + 
                    $feedbackAverages['opinions_ideas_avg'] + 
                    $feedbackAverages['sense_humer_avg'] + 
                    $feedbackAverages['energy_avg'] +  
                    $feedbackAverages['willingness_avg']) / $feedbackCount
                );
                if($feedbackTotalAverage < 3){

                        $feedback->update(['is_admin_review' => 1]);

                        $userDetail = getUserDetails($feedback->user_id);
                        $likeUserDetail = getUserDetails($feedback->like_user_id);

                        $message = ucfirst($userDetail->like_to_be_called) ." ". __('controllerText.SendReminderEmails_1') ." ". ucfirst($likeUserDetail->like_to_be_called) ." ".__('controllerText.SendReminderEmails_2');
                        $link = route('admin.user_list.reviewFeedback', $feedback->id);
                        
                        $userAdminId = 1;
                        $userAdminEmail = "admin@gmail.com";

                        $data = [
                            "admin_id" => $userAdminId, 
                            "user_id" => $feedback->user_id, 
                            "to_id" =>  $feedback->like_user_id,     
                            "message" => $message,
                            "link" => $link,   
                            'created_at' => Carbon::now(), 
                            'updated_at' => Carbon::now(),
                        ];
            
                        $ddds = AdminNotification::create($data);
                        event(new NotificationEvent($userAdminId, getAdminUnseenNotification()));
                        if($userDetail->is_subscribed == 1){
                            if (!empty($userDetail->local)) {
                                App::setLocale($userDetail->local);
                            }
                            Mail::to($userAdminEmail)->send(new ProfileManualReviewMail($userDetail, $link1, $message));
                            App::setLocale(config('app.locale'));
                        }
                }
            }
        }

        $subscriptions = Subscription::where('status', 'expired')
            ->whereDate('created_at', '>=', Carbon::now()->subMonth(2))
            ->where(function ($query) {
                $query->whereNull('last_expire_reminder')
                    ->orWhere('last_expire_reminder', '<', Carbon::now()->subDays(7));
            })
            ->where('is_renew', 0)
            ->get();

        if($subscriptions->isNotEmpty()) {
            foreach ($subscriptions as $subscription) {
                $user = $subscription->user;
                
                if($user->is_subscribed == 1){
                        $link = route('user.subscription.index');
                        if (!empty($user->local)) {
                            App::setLocale($user->local);
                        }
                        Mail::to($user->email)->send(new ExpireReminderEmail($user, $link));
                        App::setLocale(config('app.locale'));
                    }
                $subscription->update(['last_expire_reminder' => Carbon::now()]);
            }
        }
    }
}
