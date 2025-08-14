<?php

namespace App\Http\Controllers;

use App\User;

class ShowUserPictures extends Controller
{
    public function __invoke(User $user)
    {
        //$user = auth()->user();
        
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
       
       
        $pictures = $user->pictures()->latest()->get();

        return view('pictures', [
            'user' => $user,
            'pictures' => $pictures
        ]);
    }
}
