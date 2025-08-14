<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

use Carbon\Carbon;
use App\Models\ChMessage as Message;
use App\Mail\ProfileMessageMail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    public function messenger($id = null)
    {
       
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
        if(getAcceptInvite() !=0){
            $messenger_color = Auth::user()->messenger_color;
            
            return view('chat', [
                'id' => $id ?? 0,
                'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
                'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            ]);
        }else{
            return redirect('profile');
        } 
    }

    public function sendChatMail(Request $request)
    {
        $userId = $request->input('userId');
       
        $existingMessage = Message::where('seen', 0)
            ->where('is_notify', 1)
            ->whereDate('created_at', Carbon::today()) 
            ->where('to_id', $userId)
            ->exists();

        
        if(!$existingMessage) {
            
                $newChatMessage = Message::where('seen', 0)
                        ->where('is_notify', 0)
                        ->whereDate('created_at', Carbon::today())
                        ->where('to_id', $userId)
                        ->first();

                if ($newChatMessage) {  

                    $user = User::find($newChatMessage->to_id);
                    $link = route('user.chat', $newChatMessage->from_id);

                    if($user->is_subscribed == 1){
                        if (!empty($user->local)) {
                            App::setLocale($user->local);
                        }
                        Mail::to($user->email)->send(new ProfileMessageMail($user, $link));
                        App::setLocale(config('app.locale'));
                        $newChatMessage->update(['is_notify' => 1]);
                    }
                }
        }
        
        return $existingMessage;
    }
}
