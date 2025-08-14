<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Connection;
use App\Models\UserLikes;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\FollowUpMail;
use App\Mail\CancelConnectionMail;
use App\Mail\MatchWarningMail;
use App\Mail\ContinueFollowUpMail;
use App\Mail\KnowingMoreTime;
use App\Events\NotificationEvent;
use App\Models\Notification;
use App\Models\ChMessage as Message;
use App\User;
use App\Mail\PendingFeedback;
use App\Models\MeetingResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class SendFollowUpReminders extends Command
{
    protected $signature = 'reminders:follow-up';
    protected $description = 'Send follow-up messages 8 days after a match';

    public function handle()
    {
        $matchConnections = UserLikes::with('user')->where('affection', 'accept')
            ->whereNull('follow_up_at')
            ->where('follow_up_status', 0)
            ->where('is_connect', 1)
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->get();
        $link = route('meeting.followUp');
        
        if ($matchConnections->isNotEmpty()) {
            foreach ($matchConnections as $connection) {

                $followTo = UserLikes::with('user')->where('affection', 'accept')
                    ->where('user_id', $connection->liked_user_id)
                    ->whereNull('follow_up_at')
                    ->where('follow_up_status', 0)
                    ->where('is_connect', 1)
                    ->where('created_at', '<', Carbon::now()->subDays(7))
                    ->first();

                if($followTo){ 
                    $link = route('meeting.followUp');

                    $headingMessage = __('controllerText.SendFollowUpReminders_1');
                    if (!empty($connection->user->local)) { 
                        App::setLocale($connection->user->local);
                    }
                    Mail::to($connection->user->email)->send(new FollowUpMail($connection->user, $link, $headingMessage));

                    if (!empty($followTo->user->local)) {
                        App::setLocale($followTo->user->local);
                    }
                    Mail::to($followTo->user->email)->send(new FollowUpMail($followTo->user, $link, $headingMessage));
                    App::setLocale(config('app.locale'));

                    $message = ucfirst($connection->user->like_to_be_called) ." It’s been a week since your match! Have you had the chance to meet yet? We’d love to hear how it went.";
                    $message1 = ucfirst($followTo->user->like_to_be_called) ." It’s been a week since your match! Have you had the chance to meet yet? We’d love to hear how it went.";

                    $message_spanish = ucfirst($connection->user->like_to_be_called) ." ¡Ha pasado una semana desde tu coincidencia! ¿Has tenido la oportunidad de conocerse? Nos encantaría saber cómo les fue.";
                    $message_spanish1 = ucfirst($followTo->user->like_to_be_called) ." ¡Ha pasado una semana desde tu coincidencia! ¿Has tenido la oportunidad de conocerse? Nos encantaría saber cómo les fue.";
                    

                    $notificationData = [
                        [
                            "user_id" => $connection->user->id,
                            "to_id" => $followTo->user->id,
                            "message" => $message1,
                            "message-spanish" => $message_spanish1,
                            "link" => $link,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ],
                        [
                            "user_id" => $followTo->user->id,
                            "to_id" => $connection->user->id,
                            "message" => $message,
                            "message-spanish" => $message_spanish,
                            "link" => $link,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData);

                    $connection->update([
                        'follow_up_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'follow_up_status' => 1
                    ]);

                    $followTo->update([
                        'follow_up_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'follow_up_status' => 1
                    ]);

                    event(new NotificationEvent($connection->user->id, getUnseenNotification()));
                    event(new NotificationEvent($followTo->user->id, getUnseenNotification()));
                }
                
            }
        }

        $followUpReminders = UserLikes::with('user')->where('affection', 'accept')
            ->where('follow_up_at', '<', Carbon::now()->subDays(3))
            ->get();
        if ($followUpReminders->isNotEmpty()) {
            foreach($followUpReminders as $followUpReminder){
                $followUpMeeting = $followUpReminder->userMeetingStatus()->first();

                if($followUpMeeting && $followUpMeeting->follow_up_status == 1 && $followUpMeeting->already_meet == "no"){

                    $link1 = route('meeting.followUp');
                    $headingMessage = __('controllerText.SendFollowUpReminders_2');

                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    Mail::to($followUpReminder->user->email)->send(new FollowUpMail($followUpReminder->user, $link1, $headingMessage));
                    App::setLocale(config('app.locale'));

                    $message = ucfirst($followUpReminder->user->like_to_be_called) ." It’s been more than a week since your match! Have you had the chance to meet yet? We’d love to hear how it went.";
                    $message_spanish1 = ucfirst($followUpReminder->user->like_to_be_called) ." It’s been more than a week since your match! Have you had the chance to meet yet? We’d love to hear how it went.";
                    
                    $notificationData = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $message,
                            "message-spanish" => $message_spanish1,
                            "link" => $link,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 2
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }

                if($followUpMeeting && $followUpMeeting->follow_up_status == 1 && $followUpMeeting->already_meet == "yes"){

                    $link1 = route('meeting.moretime');
                    $headingMessage = __('controllerText.SendFollowUpReminders_3');

                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    Mail::to($followUpReminder->user->email)->send(new ContinueFollowUpMail($followUpReminder->user, $link1));
                    App::setLocale(config('app.locale'));

                    $message = ucfirst($followUpReminder->user->like_to_be_called) ." Great to hear you’ve connected! Would you like to continue getting to know each other?";
                    $message_spanish2 = ucfirst($followUpReminder->user->like_to_be_called) ." ¡Qué bueno saber que han conectado! ¿Te gustaría seguir conociéndose?";
                    
                    $notificationData = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $message,
                            "message-spanish" => $message_spanish2,
                            "link" => $link,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 2
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }

                if($followUpMeeting && $followUpMeeting->follow_up_status == 2 && $followUpMeeting->already_meet == "no"){
                    
                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    Mail::to($followUpReminder->user->email)->send(new CancelConnectionMail($followUpReminder->user));
                    App::setLocale(config('app.locale'));
                    $messageForCancel = ucfirst($followUpReminder->user->like_to_be_called) ." It looks like your meeting status is still pending. Would you like to cancel your connection?";
                    $messageForCancel_spanish = ucfirst($followUpReminder->user->like_to_be_called) ." Parece que el estado de tu encuentro aún está pendiente. ¿Te gustaría cancelar tu conexión?";
                    
                    $notificationData1 = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $messageForCancel,
                            "message-spanish" => $messageForCancel_spanish,
                            "link" => route('cancel.connection'),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData1);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 3
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }

                if($followUpMeeting && $followUpMeeting->follow_up_status == 2 && $followUpMeeting->already_meet == "yes" && $followUpMeeting->continue_meet == "yes"){
                    
                    $link2 = route('meeting.knowingMoreTime');
                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    Mail::to($followUpReminder->user->email)->send(new KnowingMoreTime($followUpReminder->user, $link2));
                    App::setLocale(config('app.locale'));
                    $messageForCancel = ucfirst($followUpReminder->user->like_to_be_called) ." Would you like more time to continue getting to know each other? Let us know your preference:";
                    $messageForCancel_spanish = ucfirst($followUpReminder->user->like_to_be_called) ." ¿Te gustaría más tiempo para seguir conociéndose? Cuéntanos tu preferencia:";
                    
                    $notificationData1 = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $messageForCancel,
                            "message-spanish" => $messageForCancel_spanish,
                            "link" => $link2,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData1);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 3
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }
                if($followUpMeeting && $followUpMeeting->follow_up_status == 3 && $followUpMeeting->already_meet == "no"){
                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    Mail::to($followUpReminder->user->email)->send(new MatchWarningMail($followUpReminder->user));
                    App::setLocale(config('app.locale'));
                    $messageWarning = ucfirst($followUpReminder->user->like_to_be_called) ." We noticed you haven’t connected with your match yet. If no action is taken, this connection will be automatically canceled in three days.";

                    $messageWarning_spanish = ucfirst($followUpReminder->user->like_to_be_called) ." Notamos que aún no te has conectado con tu coincidencia. Si no se toma ninguna acción, esta conexión se cancelará automáticamente en tres días.";
                    
                    $notificationData2 = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $messageWarning,
                            "message-spanish" => $messageWarning_spanish,
                            "link" => route('cancel.connection'),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData2);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 4
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }

                if($followUpMeeting && $followUpMeeting->follow_up_status == 4 && $followUpMeeting->already_meet == "no"){
                    if (!empty($followUpReminder->user->local)) {
                        App::setLocale($followUpReminder->user->local);
                    }
                    
                    Mail::to($followUpReminder->user->email)->send(new MatchConnectionCancelled($followUpReminder->user));
                    App::setLocale(config('app.locale'));
                    $messageWarning = ucfirst($followUpReminder->user->like_to_be_called) ." Your match has been automatically canceled due to inactivity.";

                    $messageWarning_spanish = ucfirst($followUpReminder->user->like_to_be_called) ." Tu coincidencia ha sido cancelada automáticamente debido a inactividad.";
                    
                    $notificationData2 = [
                        [
                            "user_id" => $followUpReminder->user->id,
                            "to_id" => $followUpReminder->user->id,
                            "message" => $messageWarning,
                            "message-spanish" => $messageWarning_spanish,
                            "link" => "",
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    ];

                    Notification::insert($notificationData2);

                    $followUpReminder->update([
                        'follow_up_at' => Carbon::now(),
                        'follow_up_status' => 5,
                        'affection' => 'exit'
                    ]);
                    
                    event(new NotificationEvent($followUpReminder->user->id, getUnseenNotification()));
                }
            }
        }

        $pendingFeedbacks = MeetingResponse::where('already_meet', 'yes')
        ->whereNotNull('continue_meet')
        ->whereDate('created_at', '<', Carbon::now()->toDateString())
        ->get();

        if ($pendingFeedbacks->isNotEmpty()) {
            foreach ($pendingFeedbacks as $pendingFeedback) {
                $profileDetail = User::find($pendingFeedback->user_id);
                
                $isExitFeedback = DB::table('feedback')
                        ->where('meeting_id', $pendingFeedback->id)
                        ->exists();

                if (!$isExitFeedback) {
                    $link = route('meeting.sendFeedback');
                    if($profileDetail->is_subscribed == 1){
                        if (!empty($profileDetail->local)) {
                            App::setLocale($profileDetail->local);
                        }
                        
                        Mail::to($profileDetail->email)->send(new PendingFeedback($profileDetail, $link));
                        App::setLocale(config('app.locale'));
                    }
                }
            }
        } 
    }
}
