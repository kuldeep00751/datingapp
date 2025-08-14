<?php

use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Models\ChMessage;  
use App\Models\Notification;
use App\Models\AdminNotification;
use App\User;
use App\Models\UserLikes;
use App\Models\Feedback;
use App\Picture;
use App\Models\MeetingResponse;
use Carbon\Carbon;
use Chatify\Facades\ChatifyMessenger;
use GuzzleHttp\Client;

use App\Models\UserMatches;

if (!function_exists('formatDate')) {
    /**
     * Format a date to a readable string.
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    function formatDate($date, $format = 'd M Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('activeSubscriptionCheck')) {
    function activeSubscriptionCheck($user = null)
    {
        $user = $user ?? auth()->user();
        return $user && $user->subscriptions()->where('status', 'active')->exists();
    }
}

if (!function_exists('checkAnySubscription')) {
    function checkAnySubscription($user = null)
    {
        $user = $user ?? auth()->user();
        return $user && $user->subscriptions()->exists();
    }
}

if (!function_exists('subscriptionPlan')) {
    /**
     * Check if the user has an active subscription.
     *
     * @param  \App\Models\User|null  $user
     * @return bool
     */
    function subscriptionPlan($planId = null)
    {
        if($planId != null){
            $plans = SubscriptionPlan::where('id',$planId)->first();
        }else{
            $plans = SubscriptionPlan::first();
        }
        return $plans;
    }
}

if (!function_exists('getUnseenMessages')) {
    function getUnseenMessages()
    {
        $isChat = getAcceptInvite() ?? 0;

        if ($isChat > 0) {
            $unseenCount = ChMessage::where('to_id', Auth::id())
                ->where('seen', false)
                ->count();
        } else {
            $unseenCount = 0;
        }

        return $unseenCount;
    }
}


if (!function_exists('getUnseenNotification')) {
    function getUnseenNotification($liked_user_id = 0)
    {
        $matchUserId = Auth::user()->match_user_id ?? 0;
        if (is_array($matchUserId)) {
            $lastId = end($matchUserId);
        } else {
            $lastId = $matchUserId; 
        }
        // $lastId = end($matchUserId);
        $userId = Auth::id();
        

        $query = DB::table('notifications')
            ->join('users', 'notifications.user_id', '=', 'users.id')
            ->join('user_likes', 'users.id', '=', 'user_likes.user_id')
            ->select('notifications.*', 'notifications.created_at as senddate', 'users.*')
            ->where('notifications.to_id', $userId);

        if ($liked_user_id != 0) {
            $query->where('notifications.user_id', $liked_user_id)
            ->where('user_likes.affection', "!=",'exit');
        }elseif($lastId !=null){
            $query->where('notifications.user_id', $lastId)
            ->where(function ($q) {
                $q->where('message', 'like', '%explore a different path this time%')
                    ->orWhere('message', 'like', '%has provided feedback about your date%')
                    ->orWhere('message', 'like', '%passed without mutual confirmation%');
            })
            ->where('user_likes.affection', "=",'exit');
        }else{
            $query->where('notifications.user_id', $liked_user_id)
            ->where('user_likes.affection', "!=",'exit');
        }

        $notify = $query->distinct('notifications.id')->count('notifications.id');
       
        return $notify;
    }
}


if (!function_exists('getAffinityPicture')) {
    function getAffinityPicture($user_id = 0)
    {
        $picture = Picture::where('user_id', $user_id);

        $pictures = [
            'pictureData' => $picture->get(),
            'pictureCount' => $picture->count(),
        ];

        return $pictures;
    }
}


if (!function_exists('getAdminUnseenNotification')) {
    function getAdminUnseenNotification()
    {
        $unseenAllCount = AdminNotification::where('admin_id', 1)
                            ->count(); 
        return $unseenAllCount; 
    }
}


if (!function_exists('getUploadImageCount')) {
    function getUploadImageCount()
    {
        if (!Auth::check()) {
            return 0;
        }
        $imageCount = User::find(Auth::id())
            ->pictures()
            ->count();
        return $imageCount;
    }
}

if (!function_exists('getMatchProfile')) {
    function getMatchProfile()
    {   
        if(auth()->check()){
           $emailMatch = UserLikes::where('user_id', auth()->user()->id)->where(function ($query) {
                $query->where('affection', 'email')
                    ->orWhere('affection', 'accept')
                    ->orWhere('affection', 'reject');
            })->pluck('liked_user_id');
        
            $matches = auth()->user()->whereIn('id', $emailMatch)->where('is_hidden', 1)->first();
            $matchesData = $matches->id ?? 0;
        }else{
                $matchesData = 0;
        }
       return  $matchesData;
    }
}

if (!function_exists('getMatchProfileAffection')) {
    function getMatchProfileAffection($liked_user_id)
    {
        $emailMatch = UserLikes::where('liked_user_id', auth()->user()->id)->where('user_id', $liked_user_id)->first();

       return $emailMatch;
    }
}

if (!function_exists('getMatchProfileStatus')) {
    function getMatchProfileStatus($userId='')
    {
        $emailMatch = UserLikes::where('user_id', auth()->user()->id)->where('liked_user_id',$userId)->first();
        $secondEmailMatch = UserLikes::where('user_id', $userId)->where('liked_user_id',auth()->user()->id)->first();
        
        if ($emailMatch) {
            $matchesData = auth()->user()->where('id', $emailMatch->liked_user_id)->where('is_hidden', 1)->first();
        } else {
            $matchesData = null;
        }

        $data =[
            "secondEmailMatch" =>$secondEmailMatch,
            "emailMatch" =>$emailMatch,
            "matchesData" =>$matchesData
        ];

        return $data;
    }
}

if (!function_exists('getAcceptInvite')) {
    function getAcceptInvite()
    {
        if(auth()->check()){
            $emailMatch = UserLikes::where('user_id', auth()->user()->id)->where('affection', '=', 'accept')->pluck('liked_user_id');
            $emailMatchReturn = UserLikes::where('liked_user_id', auth()->user()->id)->where('affection', '=', 'accept')->pluck('user_id');

            if ($emailMatch->isNotEmpty() && $emailMatchReturn->isNotEmpty()) {
                $matches = auth()->user()->whereIn('id', $emailMatch)->where('is_hidden', 1)->first();
                return $matches->id ?? 0;
            
            }
            
        }
        return 0;
    }
}

if (!function_exists('isSubscriptionActive')) {
    function isSubscriptionActive()
    {
        $subscription = Subscription::where('user_id', auth()->id())->first();

        if($subscription && $subscription->status === 'active'){
            $subscriptionData =[
                'subscription' => $subscription,
                'isactive' => 1,
            ];
        }else{
            $subscriptionData =[
                'subscription' => $subscription,
                'isactive' => 0,
            ];
        }

        return $subscriptionData;
    }
}


if (!function_exists('getSubscriptionActive')) {
    function getSubscriptionActive($userId)
    {
        $subscription = Subscription::where('user_id', $userId)->first();

        if($subscription && $subscription->status === 'active'){
            $subscriptionData =[
                'subscription' => $subscription,
                'isactive' => 1,
            ];
        }else{
            $subscriptionData =[
                'subscription' => $subscription,
                'isactive' => 0,
            ];
        }

        return $subscriptionData;
    }
}

if (!function_exists('getMatchingProfilesNow')) {
    function getMatchingProfilesNow($user)
    {
        $userminAge = $user->interested_min_age_range;
        $usermaxAge = $user->interested_max_age_range;
        $interested_in = $user->interested_in;
        $heightPrefrence = $user->height_preference;
        $userAge = Carbon::parse($user->birthday)->age;
        
        if($interested_in =="Female"){
            $interest = ["Male"];
        }elseif($interested_in =="Male"){
            $interest = ["Female"];
        }elseif($interested_in =="Male-Male"){
            $interest = ["Male-Male","Male-both"];
        }elseif($interested_in =="Female-Female"){
            $interest = ["Female-Female","Female-both"];
        }elseif($interested_in =="Male-both"){
            $interest = ["Male-Male","Male-both","Female-both"];
        }elseif($interested_in =="Female-both"){
            $interest = ["Female-Female","Female-both","Male-both"];
        }else{
            $interest = [];
        }

        $working_status = $user->working_status;
        $form_which_countries = $user->form_which_countries;
        $latitude = $user->latitude;
        $longitude = $user->longitude;
        $radius = $user->radius;
        $radius_kilometers = $radius / 1000;
        $useLockProfile = $user->is_lock_location;

        // Build the query
        $query = User::where('status', 'approved');
        
        if(!empty($interest)){
            $query->whereIn('interested_in', $interest);
        }

        $query->where('working_status', $working_status)
                    ->where('id', '!=', $user->id)
                    ->where('is_hidden', 0)
                    ->where('form_which_countries', $form_which_countries);

        if ($user->company_id != "") {
            $query->where(function($query) use ($user) {
                $query->where('company_id', '!=', $user->company_id)
                        ->orWhere('company_country', '!=', $user->company_country);
            });
        }

        if (!empty($user->match_user_id)) {
            $query->whereNotIn('id',$user->match_user_id);
        }
         
        if (!empty($heightPrefrence) && $heightPrefrence == "Taller than me") {
            $query->where('height', '>', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Shorter than me") {
            $query->where('height', '<', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Taller or equal than me") {
            $query->where('height', '>=', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Shorter or equal than me") {
            $query->where('height', '<=', $user->height);
        }
        
        $matchRecord = (clone $query)
            ->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$userminAge, $usermaxAge])
            ->count();
        
        if($matchRecord == 0){
            // if($interested_in =="Female"){
            //     $minAge = 0;  
            //     $maxAge = $userAge;
            // }elseif($interested_in =="Male"){
            //     $minAge = $userAge - 2; 
            //     $maxAge = $userAge + 15;
            // }elseif($interested_in =="Male-Male" || $interested_in =="Female-Female" 
            //         || $interested_in =="Male-both" || $interested_in =="Female-both"){
            //     $minAge = $userAge - 5;
            //     $maxAge = $userAge + 5;
            // }else{
                $minAge = $userminAge;  
                $maxAge = $usermaxAge;
            // }
            
            $query->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge]);
            
        }else{
            $query->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$userminAge, $usermaxAge]);
        }

        if ($useLockProfile == 1 && $latitude && $longitude && $radius) {
            $radius_kilometers = $radius / 1000;

            $query->where(function($q) use ($latitude, $longitude, $radius_kilometers) {
            $q->whereRaw("
                6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                ) <= ?
            ", [$latitude, $longitude, $latitude, $radius_kilometers])
            ->whereNotNull('radius')
            ->where('radius', '>', 0)
            ->whereRaw("
                6371 * acos(
                    cos(radians(latitude)) *
                    cos(radians(?)) *
                    cos(radians(?) - radians(longitude)) +
                    sin(radians(latitude)) *
                    sin(radians(?))
                ) <= radius / 1000
            ", [$latitude, $longitude, $latitude]);
        });

        }
        $query->orderBy('updated_at', 'asc');

        return $query->first();
    }
}


if (!function_exists('getMatchingProfilesNowAll')) {
    function getMatchingProfilesNowAll($user)
    {
        $userminAge = $user->interested_min_age_range;
        $usermaxAge = $user->interested_max_age_range;
        $interested_in = $user->interested_in;
        $heightPrefrence = $user->height_preference;
        $userAge = Carbon::parse($user->birthday)->age;
        
        if($interested_in =="Female"){
            $interest = ["Male"];
        }elseif($interested_in =="Male"){
            $interest = ["Female"];
        }elseif($interested_in =="Male-Male"){
            $interest = ["Male-Male","Male-both"];
        }elseif($interested_in =="Female-Female"){
            $interest = ["Female-Female","Female-both"];
        }elseif($interested_in =="Male-both"){
            $interest = ["Male-Male","Male-both","Female-both"];
        }elseif($interested_in =="Female-both"){
            $interest = ["Female-Female","Female-both","Male-both"];
        }else{
            $interest = [];
        }

        $working_status = $user->working_status;
        $form_which_countries = $user->form_which_countries;
        $latitude = $user->latitude;
        $longitude = $user->longitude;
        $radius = $user->radius;
        $radius_kilometers = $radius / 1000;
        $useLockProfile = $user->is_lock_location;

        // Build the query
        $query = User::where('status', 'approved');
        
        if(!empty($interest)){
            $query->whereIn('interested_in', $interest);
        }

        $query->where('working_status', $working_status)
                    ->where('id', '!=', $user->id)
                    ->where('is_hidden', 0)
                    ->where('form_which_countries', $form_which_countries);

        if ($user->company_id != "") {
            $query->where(function($query) use ($user) {
                $query->where('company_id', '!=', $user->company_id)
                        ->orWhere('company_country', '!=', $user->company_country);
            });
        }

        if (!empty($user->match_user_id)) {
            $query->whereNotIn('id',$user->match_user_id);
        }
         
        if (!empty($heightPrefrence) && $heightPrefrence == "Taller than me") {
            $query->where('height', '>', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Shorter than me") {
            $query->where('height', '<', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Taller or equal than me") {
            $query->where('height', '>=', $user->height);
        } elseif (!empty($heightPrefrence) && $heightPrefrence == "Shorter or equal than me") {
            $query->where('height', '<=', $user->height);
        }
        
        $matchRecord = (clone $query)
            ->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$userminAge, $usermaxAge])
            ->count();
        
        if($matchRecord == 0){
            // if($interested_in =="Female"){
            //     $minAge = 0;  
            //     $maxAge = $userAge;
            // }elseif($interested_in =="Male"){
            //     $minAge = $userAge - 2; 
            //     $maxAge = $userAge + 15;
            // }elseif($interested_in =="Male-Male" || $interested_in =="Female-Female" 
            //         || $interested_in =="Male-both" || $interested_in =="Female-both"){
            //     $minAge = $userAge - 5;
            //     $maxAge = $userAge + 5;
            // }else{
                $minAge = $userminAge;  
                $maxAge = $usermaxAge;
            // }
            
            $query->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$minAge, $maxAge]);
            
        }else{
            $query->whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN ? AND ?', [$userminAge, $usermaxAge]);
        }

        if ($useLockProfile == 1 && $latitude && $longitude && $radius) {
            $radius_kilometers = $radius / 1000;

            $query->where(function($q) use ($latitude, $longitude, $radius_kilometers) {
                $q->whereRaw("
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(latitude))
                    ) <= ?
                ", [$latitude, $longitude, $latitude, $radius_kilometers])
                ->whereNotNull('radius')
                ->where('radius', '>', 0)
                ->whereRaw("
                    6371 * acos(
                        cos(radians(latitude)) *
                        cos(radians(?)) *
                        cos(radians(?) - radians(longitude)) +
                        sin(radians(latitude)) *
                        sin(radians(?))
                    ) <= radius / 1000
                ", [$latitude, $longitude, $latitude]);
            });

        }

        $query->orderBy('updated_at', 'asc');
        
        return $query->first();
    }
}


if (!function_exists('getMatchingProfile')) {
    function getMatchingProfile($user){
        $allMatches = getMatchingProfilesNowAll($user);
        // $matchedUserIds = $allMatches->values()->all();

        // foreach ($allMatches as $matchedAt => $matchedUserId) {
            
        //     $matchUsers = User::where('id', $matchedUserId)->first(); 
        //     if($matchUsers->exit_at != null && Carbon::parse($matchUsers->exit_at)->lt(now()->subDays(2))){
        //         UserMatches::firstOrCreate([
        //             "user_id" => $user->id,
        //             "matched_user_id" => $matchedUserId,
        //         ], [
                    
        //             "matched_at" => $matchedAt,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ]);

        //     }
        //     if($matchUsers->exit_at == null){
        //         UserMatches::firstOrCreate([
        //             "user_id" => $user->id,
        //             "matched_user_id" => $matchedUserId,
        //         ], [
                    
        //             "matched_at" => $matchedAt,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ]);

        //     }
        // }
        
        // UserMatches::where('user_id', $user->id)
        // ->whereNotIn('matched_user_id', $matchedUserIds)
        // ->delete();

        // $allUserMatches = UserMatches::where('user_id', $user->id)
        //     ->orderBy('id', 'asc')  
        //     ->first();

        return $allMatches;
    }
}

if (!function_exists('createNotification')) {
    function createNotification($userId, $toId, $message, $link = "", $messageSpanish = "") {
        $data = [
            "user_id" => $userId,
            "to_id" => $toId,
            "message" => $message,
            "message-spanish" => $messageSpanish,
            "link" => $link,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        return Notification::create($data);
    }
}

if (!function_exists('getUserDetails')) {
    function getUserDetails($id) {
        $getData = User::where('id',$id)->first();
        return $getData;
    }
}

if (!function_exists('getAllAcceptInviteUser')) {
    function getAllAcceptInviteUser()
    {
        $allUser = UserLikes::where('affection','accept')->where('meeting_status',0)->get();
        
        return $allUser;
    }
}

if (!function_exists('getUserFeedback')) {
    function getUserFeedback($user_id)
    {
        $allUser = UserLikes::where('user_id',$user_id)->where('is_feedback_pending',0)->pluck('liked_user_id');
        
        // $feedbackAverages = Feedback::whereIN('user_id',[62,58,72,25,26,53,35,37,39,32])->where('like_user_id', $user_id);
        $feedbackAverages = Feedback::whereIN('user_id',$allUser)->where('like_user_id', $user_id)
        ->selectRaw('
            ROUND(AVG(photogenic), 0) as photogenic_avg, 
            ROUND(AVG(expressiveness), 0) as expressiveness_avg, 
            ROUND(AVG(attention), 0) as attention_avg, 
            ROUND(AVG(manners), 0) as manners_avg, 
            ROUND(AVG(opinions_ideas), 0) as opinions_ideas_avg, 
            ROUND(AVG(sense_humer), 0) as sense_humer_avg, 
            ROUND(AVG(energy), 0) as energy_avg, 
            ROUND(AVG(willingness), 0) as willingness_avg
        ')
        ->first();

        if (!$feedbackAverages) {
            return [
                'feedbackAverages' => null,
                'feedbackTotalAverage' => null,
            ];
        }

       
        $feedbackAverages = [
            'photogenic_avg' => (int) $feedbackAverages->photogenic_avg,
            'expressiveness_avg' => (int) $feedbackAverages->expressiveness_avg,
            'attention_avg' => (int) $feedbackAverages->attention_avg,
            'manners_avg' => (int) $feedbackAverages->manners_avg,
            'opinions_ideas_avg' => (int) $feedbackAverages->opinions_ideas_avg,
            'sense_humer_avg' => (int) $feedbackAverages->sense_humer_avg,
            'energy_avg' => (int) $feedbackAverages->energy_avg,
            'willingness_avg' => (int) $feedbackAverages->willingness_avg,
        ];
        $feedbackCount = count($feedbackAverages) ?? 1;
       
        $feedbackTotalAverage = (int) round(
            ($feedbackAverages['photogenic_avg'] + 
            $feedbackAverages['expressiveness_avg'] + 
            $feedbackAverages['attention_avg'] +
            $feedbackAverages['manners_avg'] + 
            $feedbackAverages['opinions_ideas_avg'] + 
            $feedbackAverages['sense_humer_avg'] + 
            $feedbackAverages['energy_avg'] +  
            $feedbackAverages['willingness_avg']) / $feedbackCount
        );

        return [
            'feedbackAverages' => $feedbackAverages,
            'feedbackTotalAverage' => $feedbackTotalAverage,
        ];
    }
}

if (!function_exists('getUserComment')) {
    function getUserComment($user_id, $liked_user_id)
    {
        $allUser = UserLikes::where('user_id',$user_id)->where('is_feedback_pending',0)->pluck('liked_user_id');
        // Feedbacks not yet approved
        $dataWithoutApproved = Feedback::whereIN('user_id',$allUser)->where('like_user_id', $user_id)
            ->get();

        // Feedbacks already approved
        $dataWithApproved = Feedback::whereIN('user_id',$allUser)->where('like_user_id', $user_id)
            ->where('is_publish_comments', 1)
            ->get();

        return [
            'dataWithoutApproved' => $dataWithoutApproved,
            'dataWithApproved' => $dataWithApproved,
        ];
    }
}


if (!function_exists('sendWhatsAppMessage')) {
    function sendWhatsAppMessage($to, $message) {
        // $token = "EAAZAwKUWKZC3QBO8wZBVDiJdTrs30hxIwEr7tYZBZC8xZCkkqLTqlXRnmcHcvSTYmzfiwYZA0YjWmRzcFCemhgnuoY1HQlu5bIK981m93aAV7NSJMWjwGfsA9kJ369kKwfueYnZANdV4EJ9gTLZAj2G3QCed4kWG3sOY3yc6EWhGdrCEdZBFZCDC3CuQeJGohoYXtqREY7Q6GuBlmWkW9WJl8eEFqruUGcZD";
        // $phone_number_id = "574587809070934";
        $token = "EAAQYDR9SW68BO6M0wvGcVcOT1EU1DkNJLim6UqlZBBtCALu3XXpPQHYCfnV2Rh3NaYPXjzVPX7KGTRx52zdwqMsnov1r1uwwbyudssaktvHGac0BtIQH8DnO4bV2iw6miSpUShfNcblinjoyn5MQSYEeqSzUxu76gJ917oIg4GZCZCFpmm1ZCZBedzPc6nE6vudb6WKUTwdCyJc4SQLiKFJZCNZC3EZD";
        $phone_number_id = "574587809070934";
        
        $url = "https://graph.facebook.com/v18.0/{$phone_number_id}/messages";

        $data = [
            "messaging_product" => "whatsapp",
            "to" => $to, 
            "type" => "template",
            "template" => [
                "name" => "hello_world", 
                "language" => ["code" => "en_US"]
            ]
        ];

        // Send request and capture response
        $response = Http::withHeaders([
            "Authorization" => "Bearer $token",
            "Content-Type" => "application/json"
        ])->post($url, $data);
       
        // Debugging: Check response
        $result = $response->json();
       
    
        return $result;
    }
}


if (!function_exists('sendTelerivetSms')) {
    function sendTelerivetSms($to, $message) {
        $apiKey = env('TELERIVET_API_KEY');
        $projectId = env('TELERIVET_PROJECT_ID');

        if (!$apiKey || !$projectId) {
            return ['success' => false, 'message' => 'API credentials are missing.'];
        }

        try {
            $client = new Client();
            $response = $client->post("https://api.telerivet.com/v1/projects/{$projectId}/messages/send", [
                'auth' => [$apiKey, ''],
                'form_params' => [
                    'content' => $message,
                    'to_number' => $to
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            return ['success' => true, 'message' => 'Message sent successfully!', 'response' => $data];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}

if (!function_exists('dashboardData')) {
    function dashboardData() {
        $TotalSubscriptions = Subscription::distinct('user_id')->count(); 
        $TotalUsers = User::count();
        $TotalPlans = SubscriptionPlan::count();

        return [
            'TotalSubscriptions' => $TotalSubscriptions,
            'TotalUsers' => $TotalUsers,
            'TotalPlans' => $TotalPlans,
        ];
    }
}

if (!function_exists('isActiveFeedback')) {
    function isActiveFeedback() {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        $user_id = $user->id;
        $matchUserId = $user->match_user_id;
        $lastId = is_array($matchUserId) ? end($matchUserId) : $matchUserId;
        $user_like = $user->likeUserData()->first();

        $isPending = UserLikes::where('user_id', $user_id)
            ->where('liked_user_id', $lastId)
            ->where('is_feedback_pending', 1)
            ->exists();

        if ($user_like && $user_like->meeting_status == 1) {
            $res = MeetingResponse::where('user_id', $user_id)
                ->where('user_like_id', $user_like->liked_user_id)
                ->where('already_meet', 'yes')
                ->where('continue_meet', 'yes')
                ->exists();

            $feedbackExists = Feedback::where('like_user_id', $user_id)
                ->where('user_id', $user_like->liked_user_id)
                ->exists();

            return $res && !$feedbackExists;
        }

        return $isPending;
    }
}

if(!function_exists('isFeedbackComment')) {
    function isFeedbackComment() {
        $user_id=auth()->user()->id;
        $meeting_user_id=getAcceptInvite();
        
        $matchUserId = Auth::user()->match_user_id;

        if (is_array($matchUserId)) {
            $lastId = end($matchUserId);
        } else {
            $lastId = $matchUserId; 
        }

        if(!$meeting_user_id && $lastId) {
            $feedbackId = Feedback::where('like_user_id', $user_id)->where('user_id', $lastId)->first();
            $comment = UserLikes::where('user_id', $user_id)
            ->where('liked_user_id', $lastId)
            ->where('comments', '!=', null)
            ->where('comments', '!=', '')
            ->first();
            
            $data = [
                'comment_id' => $comment->id ?? 0,
                'feedback_id' => $feedbackId->id ?? 0,
            ];
        } else {
            $data = ['comment_id' => 0, 'feedback_id' => 0];
        }
        return $data;
    }
}

