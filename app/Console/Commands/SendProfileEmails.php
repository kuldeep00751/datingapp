<?php

namespace App\Console\Commands;
use App\User;
use App\Mail\NewProfilesMail;
use App\Mail\NewProfilesReceiverMail;
use App\Mail\ProfilesWaitingMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Events\NotificationEvent;
use App\Models\Notification;
use Carbon\Carbon;
use App\Mail\TestMail;
use Illuminate\Support\Facades\App;

class SendProfileEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:profile-emails';

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
        //dd(Carbon::now()->toDateTimeString());
        // $users = User::where('status', 'approved')
        //     ->where('is_hidden', 0)
        //     //->where('interested_in', 'Female')
        //     ->get();

        // $orderedIds = $users->sortBy('is_available')->where('updated_at','asc')->pluck('id')->values()->all();
        // $users1 = $orderedIds;

        $users1 = User::where('status', 'approved')
            ->where('is_hidden', 0)
            //->where('id', 40)
            // ->orderBy('is_available')
            ->orderBy('updated_at', 'asc')
            ->pluck('id')
            ->values()
            ->all();
       
        //dd($orderedIds);

        // if ($users1) {
        //     $processCount = 1;
        //     $connections = []; 

        //     foreach ($users1 as $userdata) {
        //         $user = getUserDetails($userdata); 
        //         $allMatchProfile = getMatchingProfile($user);

        //         $connections[$user->id] = $allMatchProfile; 
        //     }

        //     dd($connections); 
        // }


        if ($users1) {
            $processCount = 1;
            foreach ($users1 as $userdata) {
                $user = getUserDetails($userdata);

                $profile = getMatchingProfile($user);
                //  dd($profile);
                if ($profile) {
                        //$profile = $allMatchProfile->userData;
                       
                        $userLikeExists1 = DB::table('user_likes')
                            ->where(function ($query) use ($profile, $user) {
                                $query->where('user_id', $profile->id)
                                    ->orWhere('liked_user_id', $user->id);
                            })
                            ->where('affection', 'email')
                            ->exists();
                
                        $userLikeExists2 = DB::table('user_likes')
                            ->where(function ($query) use ($profile, $user) {
                                $query->where('user_id', $user->id)
                                    ->orWhere('liked_user_id', $profile->id);
                            })
                            ->where('affection', 'email')
                            ->exists(); 
                
                        
                    if (!$userLikeExists1 && !$userLikeExists2) {
                   
                        $userSubscription  = activeSubscriptionCheck($user);
                        $matchUserSubscription  = activeSubscriptionCheck($profile);

                        // ($user->exit_at == null && ($user->last_email_sent_at == null || $user->last_email_sent_at < Carbon::now()->subDays(3)) && $userSubscription==true && $matchUserSubscription == true)
                        // (($user->exit_at == null || $user->last_email_sent_at == null )&& $userSubscription==true && $matchUserSubscription == true)
                        if($user->exit_at == null && ($user->last_email_sent_at == null || $user->last_email_sent_at < Carbon::now()->subDays(2)) && $userSubscription==true && $matchUserSubscription == true){
                           
                            DB::table('user_likes')->insert([
                                'user_id' => $user->id,
                                'liked_user_id' => $profile->id,
                                'affection' => 'email',
                                'is_profile_view'=>1, //after test chnage this line hide
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            DB::table('user_likes')->insert([
                                'user_id' => $profile->id,
                                'liked_user_id' => $user->id,
                                'affection' => 'email',
                                'is_profile_view'=>1, //after test chnage this line hide
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            $matchUserIds = ($user->match_user_id !=null) ? $user->match_user_id : [];
                            $matchUserIds[] = $profile->id;

                            $matchProfileIds = ($profile->match_user_id!=null) ? $profile->match_user_id :[];
                            $matchProfileIds[] = $user->id;

                            $user->update([
                                'last_email_sent_at' => Carbon::now(),
                                'is_hidden' => 1,
                                'match_user_id' =>$matchUserIds
                            ]);
                            
                            $profile->update([
                                'last_email_sent_at' => Carbon::now(),
                                'is_hidden' => 1,
                                'match_user_id' =>$matchProfileIds
                            ]);

                            // DB::table('user_matches')
                            // ->where(function ($query) use ($allMatchProfile) {
                            //     $query->where('user_id', $allMatchProfile->user_id)
                            //         ->where('matched_user_id', $allMatchProfile->matched_user_id);
                            // })
                            // ->orWhere(function ($query) use ($allMatchProfile) {
                            //     $query->where('user_id', $allMatchProfile->matched_user_id)
                            //         ->where('matched_user_id', $allMatchProfile->user_id);
                            // })
                            // ->delete();

                            $link = "";
                            $messageForProfile = $profile->like_to_be_called . " profile match to Your Preferences!";
                            $messageForProfile_spanish = $profile->like_to_be_called . " ¡Perfil que coincide con tus preferencias!";
                            createNotification($profile->id, $user->id, $messageForProfile, $link,$messageForProfile_spanish);

                            // Notification for $user
                            $messageForUser = $user->like_to_be_called . " profile match to Your Preferences!";
                            $messageForUser_spanish = $user->like_to_be_called . " ¡Perfil que coincide con tus preferencias!";
                            createNotification($user->id, $profile->id, $messageForUser, $link,$messageForUser_spanish);

                            event(new NotificationEvent($profile->id, getUnseenNotification()));
                            event(new NotificationEvent($user->id, getUnseenNotification()));

                            if($user->is_subscribed == 1){
                                if (!empty($user->local)) {
                                    App::setLocale($user->local);
                                }
                                Mail::to($user->email)->send(new NewProfilesMail($profile, $user));
                                App::setLocale(config('app.locale'));
                            } 
                            
                            if($profile->is_subscribed == 1){
                                if (!empty($profile->local)) {
                                    App::setLocale($profile->local);
                                }
                                Mail::to($profile->email)->send(new NewProfilesReceiverMail($profile, $user));
                                App::setLocale(config('app.locale'));
                            }
                            
                        } 
                        
                        
                        if ($user->exit_at != null && Carbon::parse($user->exit_at)->lt(now()->subDays(2))) {
                            
                            if($user->is_subscribed == 1){
                                if (!empty($user->local)) {
                                    App::setLocale($user->local);
                                }
                                Mail::to($user->email)->send(new NewProfilesMail($profile, $user));
                                App::setLocale(config('app.locale'));
                            }

                            if($profile->is_subscribed == 1){
                                if (!empty($profile->local)) {
                                    App::setLocale($profile->local);
                                }
                                Mail::to($profile->email)->send(new NewProfilesReceiverMail($profile, $user));
                                App::setLocale(config('app.locale'));
                            }

                            DB::table('user_likes')->insert([
                                'user_id' => $profile->id,
                                'liked_user_id' => $user->id,
                                'affection' => 'email',
                                'is_profile_view'=>1, //after test chnage this line hide
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            DB::table('user_likes')->insert([
                                'user_id' => $user->id,
                                'liked_user_id' => $profile->id,
                                'affection' => 'email',
                                'is_profile_view'=>1, //after test chnage this line hide
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            $matchUserIds = ($user->match_user_id !=null) ? $user->match_user_id : [];
                            $matchUserIds[] = $profile->id;

                            $matchProfileIds = ($profile->match_user_id!=null) ? $profile->match_user_id :[];
                            $matchProfileIds[] = $user->id;

                            $user->update([
                                'last_email_sent_at' => now(),
                                'is_hidden' => 1,
                                'match_user_id' =>$matchUserIds
                            ]);
                            
                            $profile->update([
                                'last_email_sent_at' => now(),
                                'is_hidden' => 1,
                                'match_user_id' =>$matchProfileIds
                            ]);

                            // DB::table('user_matches')
                            // ->where(function ($query) use ($allMatchProfile) {
                            //     $query->where('user_id', $allMatchProfile->user_id)
                            //         ->where('matched_user_id', $allMatchProfile->matched_user_id);
                            // })
                            // ->orWhere(function ($query) use ($allMatchProfile) {
                            //     $query->where('user_id', $allMatchProfile->matched_user_id)
                            //         ->where('matched_user_id', $allMatchProfile->user_id);
                            // })
                            // ->delete();

                            $link1 ="";
                            $unseenNotiCount = getUnseenNotification();
                            $messageForProfile = $profile->like_to_be_called . " profile match to Your Preferences!";
                            $messageForProfile_spanish = $profile->like_to_be_called . " ¡Perfil que coincide con tus preferencias!";
                            createNotification($profile->id, $user->id, $messageForProfile, $link1, $messageForProfile_spanish);

                            // Notification for $user
                            $messageForUser = $user->like_to_be_called . " profile match to Your Preferences!";
                            $messageForUser_spanish = $user->like_to_be_called . " ¡Perfil que coincide con tus preferencias!";
                            createNotification($user->id, $profile->id, $messageForUser, $link1, $messageForUser_spanish);

                            // Trigger events
                            event(new NotificationEvent($profile->id, $unseenNotiCount));
                            event(new NotificationEvent($user->id, $unseenNotiCount)); 

                            
                        }
                    }
                  DB::table('users')->where('id', $user->id)->update(['is_available' => $processCount]);
                }else{
                    $userSubscription  = activeSubscriptionCheck($user);
                    if($user->exit_at != null){
                        if ($user->last_email_sent_at == null || $user->last_email_sent_at < Carbon::now()->subDays(7) ) {
                            if($user->is_subscribed == 1){
                                if (!empty($user->local)) {
                                    App::setLocale($user->local);
                                }
                                Mail::to($user->email)->send(new ProfilesWaitingMail($user));
                                App::setLocale(config('app.locale'));
                            }
                            $user->update([
                                'last_email_sent_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }else{
                        $subscription = activeSubscriptionCheck($user);
                        
                        $userData = User::where('status', 'approved')->where('is_hidden',0)->where('id',$user->id)->first();

                        if (($userData->last_email_sent_at == null || $userData->last_email_sent_at < Carbon::now()->subDays(7)) && $subscription==true) {
                            if($userData->is_subscribed == 1){
                                if (!empty($userData->local)) {
                                    App::setLocale($userData->local);
                                }
                                Mail::to($userData->email)->send(new ProfilesWaitingMail($userData));
                                App::setLocale(config('app.locale'));
                            }
                            $userData->update([
                                // 'last_email_sent_at' => Carbon::now(),
                                'last_email_sent_at' => Carbon::now()->subDays(3),   //after test chnage this line
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                    DB::table('users')->where('id', $user->id)->update(['is_available' => 0]); 
                }
                $processCount++;

                // Optionally reset the locale if needed
                App::setLocale(config('app.locale'));
            }
        }
        return Command::SUCCESS;
    }
}
