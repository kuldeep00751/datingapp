<?php

namespace App\Http\Controllers;

use App\Mail\SendMatchedEmail;
use App\User;
use App\Models\UserLikes;
use Illuminate\Support\Facades\Mail;
use App\Events\NotificationEvent;

class ViewLikesController extends Controller
{
    public function __invoke()
    {
        /** @var User $user */
        $user = auth()->user();

        if(auth()->user()->status == "Pending" || auth()->user()->status == "pending")
        {
            return redirect('approve-pending');
        }
        
        elseif(auth()->user()->status == "rejected")
        {
            return redirect('account-rejected');
        }
        
        elseif(auth()->user()->status == "approved" && !activeSubscriptionCheck())
        {
            return redirect('payment-now');
        }elseif(auth()->user()->status == "" || auth()->user()->status == null){
            return redirect('profile');
        }

        //users, which I liked
        $liked = auth()->user()->affections()->where('affection', '=', 'like')->pluck('liked_user_id');
        $likedUserID = auth()->user()->whereIn('id', $liked)->isHidden()->get();

        //users, which I disliked
        $disliked = auth()->user()->affections()->where('affection', '=', 'dislike')->pluck('liked_user_id');
        $dislikedUserID = auth()->user()->whereIn('id', $disliked)->isHidden()->get();

        //my matches
        $usersWhoLikedMe = auth()->user()->affectedBy()->where('affection', '=', 'like')->pluck('user_id');
        $likedEachOther = $liked->merge($usersWhoLikedMe);
        $matchedUsers = $likedEachOther->duplicates();
        $matches = $user->whereIn('id', $matchedUsers)->get();

        //matched user emails
        $matchesEmail = $user->whereIn('id', $matchedUsers)->pluck('email')->all();

        $emailMatch = UserLikes::where('user_id', auth()->user()->id)->where('affection', '=', 'email')->pluck('liked_user_id');
        $emailMatchUser = auth()->user()->whereIn('id', $emailMatch)->where('is_hidden', 1)->get();
       
        if (count($matchedUsers) != 0)
        {
            foreach ($matchesEmail as $email) {
                
                $userLike = UserLikes::where('user_id', $matchedUsers)
                                    ->where('liked_user_id', auth()->id())
                                    ->first();
                $authUserLike = UserLikes::where('user_id', auth()->id())
                                    ->where('liked_user_id', $matchedUsers)
                                    ->first();

                if ($userLike && is_null($userLike->match_email_send_at)) {
                    
                    Mail::to($email)->send(new SendMatchedEmail($user));
                    $userLike->update(['match_email_send_at' => now()]);
                }
                
                if ($authUserLike && is_null($authUserLike->match_email_send_at)) {

                    Mail::to($user->email)->send(new SendMatchedEmail($user));
                    $authUserLike->update(['match_email_send_at' => now()]);
                }
            }
            
        }

        return view('view-likes', [
            'user' => $user,
            'likedUserID' => $likedUserID,
            'dislikedUserID' => $dislikedUserID,
            'matches' => $emailMatchUser,
        ]);
    }
}
