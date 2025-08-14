<?php

namespace App\Http\Controllers;

class ShowAuthorizedUserPicture extends Controller
{
    public function __invoke()
    {
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
        }
        $pictures = $user->pictures()->get();

        return view('my-pictures', [
            'user' => $user,
            'pictures' => $pictures
        ]);
    }
}
