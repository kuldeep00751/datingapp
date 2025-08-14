<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\DB;
use App\Mail\NewProfilesMail;
use Illuminate\Support\Facades\Mail;

class ShowAllUsersController extends Controller
{
    public function __invoke(Request $request)
    {
    
        // Get the authenticated user
        /**  @var User $user */
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

        return view('show-all');
    }

    public function getMatchResult(Request $request){
        $searchValue = $request->query('search');
    
        $minAge = $request->input('interested_min_age_range');
        $maxAge = $request->input('interested_max_age_range');
        $interested_in = $request->input('interested_in');
        $married_status = $request->input('married_status');
        $working_status = $request->input('working_status');

        $form_which_countries = $request->input('form_which_countries');
        

        $user = auth()->user();
        
        $followUserIDs = DB::table('user_likes')
            ->select('user_likes.liked_user_id')
            ->where('user_likes.user_id', '=', auth()->id())
            ->where('user_likes.affection', '=', 'like')
            ->pluck('user_likes.liked_user_id');

        $likedUserIDs = DB::table('user_likes')
            ->select('user_likes.user_id')
            ->where('user_likes.liked_user_id', '=', auth()->id())
            ->where('user_likes.affection', '=', 'like')
            ->pluck('user_likes.user_id');
        
// dd($likedUserIDs);
        // $query = User::where('status', '=', 'approved')->inRandomOrder()->withoutMe()->withoutLiked()->withoutDisliked()->isHidden();
        $query = User::where('status', '=', 'approved')->withoutMe()->withoutDisliked()->isHidden();
       
        if ($searchValue) {
            $query = $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('location', 'like', '%' . $searchValue . '%');
            });
        }

        // Filter by age
        if ($minAge || $maxAge) {
            if ($minAge) {
                $maxDate = now()->subYears($minAge)->toDateString();
                $query->where('birthday', '<=', $maxDate);
            }
        
            if ($maxAge) {
                $minDate = now()->subYears($maxAge)->toDateString();
                $query->where('birthday', '>=', $minDate);
            }
        }
        
        if($married_status){
            $query->where('married_status', $married_status);
        }

        if($form_which_countries){
            $query->where('form_which_countries', $form_which_countries);
        }

        

        if($working_status){
            $query->where('working_status', $working_status);
        }

        if ($interested_in){
            if ($interested_in == 'Male') {
                $query->onlyMale();
            } elseif ($interested_in == 'Female') {
                $query->onlyFemale();
            } elseif ($interested_in == 'LGBTIQ+') {
                $query->onlyLGBTIQ();
            }
        }

        $users = $query->get();

        // return response()->json($users);
        return response()->json([
            'users' => $users,
            'followUserIDs' => $followUserIDs,
            'likedUserIDs' => $likedUserIDs,
        ]);
    }
}
