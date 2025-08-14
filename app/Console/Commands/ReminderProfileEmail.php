<?php
namespace App\Console\Commands;
use App\User;
use App\Mail\ReminderProfilesMail;
use App\Mail\ReminderProfilesReceiverMail;
use App\Mail\ReminderExpiredProfilesMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\UserLikes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\NotificationEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\App;

class ReminderProfileEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder-profile-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new profiles to users based on their preferences';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userlikes = UserLikes::where('affection', 'email')
        ->where('updated_at', '<', Carbon::today())
        // ->whereIn('user_id',[71,13])
        ->get();

        if ($userlikes->isNotEmpty()) {
            foreach ($userlikes as $userlike) {
                $userExists1 = User::find($userlike->user_id);
                $profile = User::find($userlike->liked_user_id);

                $count_email = $userlike->count_email;

                if ($count_email < 3) {
                    if($userExists1->is_subscribed == 1){
                        if (!empty($userExists1->local)) {
                            App::setLocale($userExists1->local);
                        }
                        Mail::to($userExists1->email)->send(new ReminderProfilesMail(null, $profile->id));
                        App::setLocale(config('app.locale'));
                    }
                    
                    $countemail=$count_email + 1;
                    
                    $userlike->update([
                        'updated_at' => Carbon::today(),
                        'count_email' => $countemail
                    ]);
                    
                    $messageForProfile = $profile->like_to_be_called ." ". __('controllerText.ReminderProfileEmail_1');
                    
                    $messageForProfile1 = ucfirst($profile->like_to_be_called) ." profile matching your preferences is waiting for you! Don’t miss this chance to connect.";
                    $messageForProfile_spanish =ucfirst($profile->like_to_be_called) ." ¡Un perfil que coincide con tus preferencias te está esperando! No pierdas esta oportunidad de conectar.";

                    $notificationData = [
                        [
                            "user_id" => $profile->id,
                            "to_id" => $userExists1->id,
                            "message" => $messageForProfile1,
                            "message-spanish" => $messageForProfile_spanish,
                            // "link" => $link,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ],
                    ];

                    Notification::insert($notificationData);
                    event(new NotificationEvent($userExists1->id, getUnseenNotification()));      
                    
                } else {
                    $countemail=$count_email + 1;
                    $now = now();

                    if ($userExists1->is_subscribed == 1) {
                        if (!empty($userExists1->local)) {
                            App::setLocale($userExists1->local);
                        }
                        Mail::to($userExists1->email)->send(new ReminderExpiredProfilesMail($userExists1, $profile));
                        App::setLocale(config('app.locale'));
                    }

                    // if ($profile->is_subscribed == 1) {
                    //     Mail::to($profile->email)->send(new ReminderExpiredProfilesMail($userExists1, $profile));
                    // }

                    $message = __('controllerText.ReminderProfileEmail_2');

                    $messageForProfile2 = "The connection request has expired. Since more than 4 days passed without mutual confirmation, the match was automatically closed.";
                    $messageForProfile_spanish2 ="La solicitud de conexión ha expirado. Como pasaron más de 4 días sin confirmación mutua, la coincidencia se cerró automáticamente.";

                    // Update both users
                    $userExists1->update([
                        'last_email_sent_at' => $now,
                        'exit_at' => $now,
                        'is_hidden' => 0,
                    ]);

                    // $profile->update([
                    //     'last_email_sent_at' => $now,
                    //     'exit_at' => $now,
                    //     'is_hidden' => 0,
                    // ]);

                    // Update userlike
                    $userlike->update([
                        'affection' => 'exit',
                        'updated_at' => $now,
                        'count_email' => $countemail,
                    ]);

                    // Update reverse user_like if exists
                    // DB::table('user_likes')
                    //     ->where('user_id', $userlike->liked_user_id)
                    //     ->where('liked_user_id', $userlike->user_id)
                    //     ->update([
                    //         'affection' => 'exit',
                    //         'updated_at' => $now,
                    //         'count_email' => $countemail,
                    //     ]);
                    
                
                    // Notifications
                    $notificationData1 = [
                        [
                            "user_id" => $profile->id,
                            "to_id" => $userExists1->id,
                            "message" => $messageForProfile2,
                            "message-spanish" => $messageForProfile_spanish2,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                        // ,
                        // [
                        //     "user_id" => $profile->id,
                        //     "to_id" => $userExists1->id,
                        //     "message" => $message,
                        //     'created_at' => Carbon::now(),
                        //     'updated_at' => Carbon::now(),
                        // ]
                    ];

                    Notification::insert($notificationData1);
                    event(new NotificationEvent($userExists1->id, getUnseenNotification($userExists1->id)));
                    // event(new NotificationEvent($profile->id, getUnseenNotification($profile->id))); 
                }
            }
        }

        return Command::SUCCESS;
    }
}