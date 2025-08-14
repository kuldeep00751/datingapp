<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Feedback;

class ShowUserInfoController extends Controller
{
    public function __invoke(User $user)
    {
        // if (!getMatchProfile()) {
            
        //     return redirect('/profile');
        // }

        $pictures = $user->pictures()->latest()->get();

        //users, which I liked
        $liked = auth()->user()->affections()->where('affection', '=', 'like')->pluck('liked_user_id');
        $likedUserID = auth()->user()->whereIn('id', $liked)->get();

        //users, which I disliked
        $disliked = auth()->user()->affections()->where('affection', '=', 'dislike')->pluck('liked_user_id');
        $dislikedUserID = auth()->user()->whereIn('id', $disliked)->get();

        //my matches
        $usersWhoLikedMe = auth()->user()->affectedBy()->where('affection', '=', 'like')->pluck('user_id');
        $likedEachOther = $liked->merge($usersWhoLikedMe);
        $matchedUsers = $likedEachOther->duplicates();
        $matches = $user->whereIn('id', $matchedUsers)->first();
        
        $user_id=auth()->user()->id;
        $feedback = Feedback::where('like_user_id',$user->id)->first();
        

        //$Auth_User_Data = auth()->user();
        $childrenData =[
            "1"=>__('messages.profile_26_option1'),
            "2"=>__('messages.profile_26_option2'),
        ];
        
        $childrenHaveMany =[
            "1"=>__('messages.profile_28_option1'),
            "2"=>__('messages.profile_28_option2'),
            "3"=>__('messages.profile_28_option3'),
            "4"=>__('messages.profile_28_option4'),
        ];

        $petsData =[
            "frequent"=>__('messages.profile_45_option1'),
            "occasional"=>__('messages.profile_45_option2'),
            "vacations"=>__('messages.profile_45_option3'),
        ];

        $alcoholData = [
            "never"=>__('messages.profile_30_option1'),
            "daily"=>__('messages.profile_30_option2'),
            "weekends"=>__('messages.profile_30_option3'),
            "occasionally"=>__('messages.profile_30_option4'),
        ];

        $smokeData = [
            "never"=>__('messages.profile_31_option1'),
            "daily"=>__('messages.profile_31_option2'),
            "occasionally"=>__('messages.profile_31_option3'),
            "quitting"=>__('messages.profile_31_option4'),
        ];

        $workoutData = [
            "never"=>__('messages.profile_@33_option1'),
            "daily"=>__('messages.profile_@33_option2'),
            "often"=>__('messages.profile_@33_option3'),
            "sometimes"=>__('messages.profile_@33_option4'),
        ];

        $travelFrecuencyData = [
            "frequent"=>__('messages.profile_34_option3'),
            "occasional"=>__('messages.profile_34_option2'),
            "vacations"=>__('messages.profile_34_option1'),
        ];

        $interestInData = [
            "Female"=>__('messages.profile_15_option1'),
            "Male"=>__('messages.profile_15_option2'),
            "Male-Male"=>__('messages.profile_15_option3'),
            "Female-Female"=>__('messages.profile_15_option4'),
            "Male-both"=>__('messages.profile_15_option5'),
            "Female-both"=>__('messages.profile_15_option6'),
        ];

        return view('view', [
            'user' => $user,
            'pictures' => $pictures,
            'likedUserID' => $likedUserID,
            'dislikedUserID' => $dislikedUserID,
            'match' => $matches,
            'childrenData' => $childrenData,
            'childrenHaveMany' => $childrenHaveMany,
            'petsData' => $petsData,
            'alcoholData' => $alcoholData,
            'smokeData' => $smokeData,
            'workoutData' => $workoutData,
            'travelFrecuencyData' => $travelFrecuencyData,
            'interestInData' =>$interestInData,
            'feedback' =>$feedback,
        ]);
    }
}
