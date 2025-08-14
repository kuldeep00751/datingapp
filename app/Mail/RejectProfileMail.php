<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectProfileMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile_name;
    public $user_name;
    public $user_id;

    public function __construct($profilesName, $userName, $user_id)
    {
        $this->profile_name = $profilesName;
        $this->user_name = $userName;
        $this->user_id = $user_id;
    }

    public function build()
    {
        return $this->view('emails.reject_profile',[
                    'profile_name' =>$this->profile_name,
                    'user_name' =>  $this->user_name,
                    'user_id'=>  $this->user_id
                ])->subject(__('emailsText.RejectProfileMail_subject'));
    }
}
