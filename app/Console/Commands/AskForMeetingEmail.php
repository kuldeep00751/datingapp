<?php
namespace App\Console\Commands;
use App\User;
use App\Mail\ReminderProfilesMail;
use App\Mail\SubmitMeetingStatus;
use App\Mail\ReminderSubmitMeetingStatus;
use App\Mail\KnowingMoreTime;
use App\Mail\CancelConnectionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Models\UserLikes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\NotificationEvent;
use App\Models\Notification;

class AskForMeetingEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:ask-about-meeting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ask them about meeting';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \DB::statement('TRUNCATE TABLE notifications');
        \DB::statement('TRUNCATE TABLE user_likes');
        \DB::statement('TRUNCATE TABLE feedback');
        \DB::statement('TRUNCATE TABLE `admin-notifications`');
        $users1 = User::all(); 

        foreach ($users1 as $user) {
            $user->update([
                'last_email_sent_at' => null,
                'exit_at' => null,
                'is_hidden' => 0,
                'match_user_id' => null,
                'last_reminder' => null,
                'is_available' => 0,
                'updated_at' => $user->created_at
            ]);
        }
        // $meetingStatus = UserLikes::where('affection', 'accept')
        //     ->where('meeting_status', '>', 0)
        //     ->get();

        // foreach ($meetingStatus as $meetingsdata) {
        //     $userExists1 = $meetingsdata->userMeetingStatus()->first();

        //     $today = Carbon::today();
        //     $meetingDate = Carbon::parse($userExists1->meeting_date);
        //     $daysSinceMeeting = $meetingDate->diffInDays($today);

        //     if($userExists1 && $userExists1->status==1 && $daysSinceMeeting == 1){

        //         $userDetail = getUserDetails($userExists1->user_id);

        //         Mail::to($userDetail->email)->send(new SubmitMeetingStatus($userDetail)); 
        //         $message = ucfirst($userDetail->like_to_be_called) ." ". "Please submit your meeting status.";

        //         $link = route('meeting.meetingstatus');
        //         $data = [
        //             "user_id" => $userDetail->id, 
        //             "to_id" =>  $userDetail->id,     
        //             "message" => $message,
        //             "link" => $link,   
        //             'created_at' => Carbon::now(), 
        //             'updated_at' => Carbon::now(),
        //         ];

        //         Notification::create($data);
        //         $meetingsdata->update(['meeting_status' => 2]);

        //         $unseenNotiCount = getUnseenNotification();
        //         $userId = $userDetail->id;

        //         event(new NotificationEvent($userId, $unseenNotiCount));
        //     }

        //     if($userExists1 && $userExists1->status==1 && $daysSinceMeeting == 5){

        //         $userDetail = getUserDetails($userExists1->user_id);

        //         Mail::to($userDetail->email)->send(new ReminderSubmitMeetingStatus($userDetail)); 
        //         $message = ucfirst($userDetail->like_to_be_called) ." ". "We noticed you haven't updated the status of your meeting";

        //         $link = route('meeting.meetingstatus');
        //         $data = [
        //             "user_id" => $userDetail->id, 
        //             "to_id" =>  $userDetail->id,     
        //             "message" => $message,
        //             "link" => $link,   
        //             'created_at' => Carbon::now(), 
        //             'updated_at' => Carbon::now(),
        //         ];

        //         Notification::create($data);
        //         $meetingsdata->update(['meeting_status' => 4]);

        //         $unseenNotiCount = getUnseenNotification();
        //         $userId = $userDetail->id;

        //         event(new NotificationEvent($userId, $unseenNotiCount));
        //     }

        //     if($userExists1 && $userExists1->status==1 && $daysSinceMeeting == 6){

        //         $userDetail = getUserDetails($userExists1->user_id);

        //         Mail::to($userDetail->email)->send(new CancelConnectionMail($userDetail)); 
        //         $message = ucfirst($userDetail->like_to_be_called) ." ". "Do you want to cancel your connection?";

        //         $link = route('cancel.connection');
        //         $data = [
        //             "user_id" => $userDetail->id, 
        //             "to_id" =>  $userDetail->id,     
        //             "message" => $message,
        //             "link" => $link,   
        //             'created_at' => Carbon::now(), 
        //             'updated_at' => Carbon::now(),
        //         ];

        //         Notification::create($data);
        //         $meetingsdata->update(['meeting_status' => 5]);

        //         $unseenNotiCount = getUnseenNotification();
        //         $userId = $userDetail->id;

        //         event(new NotificationEvent($userId, $unseenNotiCount));
        //     }

        //     if($userExists1 && $userExists1->status==1 && $daysSinceMeeting == 7){

        //         $userDetail = getUserDetails($userExists1->user_id);

        //         Mail::to($userDetail->email)->send(new KnowingMoreTime($userDetail)); 
        //         $message = ucfirst($userDetail->like_to_be_called) ." ". "Do you want to more time to knowing your match";

        //         $link = route('meeting.moretime');
        //         $data = [
        //             "user_id" => $userDetail->id, 
        //             "to_id" =>  $userDetail->id,     
        //             "message" => $message,
        //             "link" => $link,   
        //             'created_at' => Carbon::now(), 
        //             'updated_at' => Carbon::now(),
        //         ];

        //         Notification::create($data);
        //         $meetingsdata->update(['meeting_status' => 6]);

        //         $unseenNotiCount = getUnseenNotification();
        //         $userId = $userDetail->id;

        //         event(new NotificationEvent($userId, $unseenNotiCount));
        //     }

        //     // if($userExists1 && $userExists1->status==8 && $userExists1->more_time_status==1 && $meetingsdata->meeting_status == 6){

        //     //     $userDetail = getUserDetails($userExists1->user_id);

        //     //     Mail::to($userDetail->email)->send(new SubmitFeedback($userDetail)); 
        //     //     $message = ucfirst($userDetail->like_to_be_called) ." ". "Do you want to more time to knowing your match";

        //     //     $link = route('meeting.moretime');
        //     //     $data = [
        //     //         "user_id" => $userDetail->id, 
        //     //         "to_id" =>  $userDetail->id,     
        //     //         "message" => $message,
        //     //         "link" => $link,   
        //     //         'created_at' => Carbon::now(), 
        //     //         'updated_at' => Carbon::now(),
        //     //     ];

        //     //     Notification::create($data);
        //     //     $meetingsdata->update(['meeting_status' => 6]);

        //     //     $unseenNotiCount = getUnseenNotification();
        //     //     $userId = $userDetail->id;

        //     //     event(new NotificationEvent($userId, $unseenNotiCount));
        //     // }
        // }

        // return Command::SUCCESS;
    }
}
