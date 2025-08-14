<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProfilesMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile;
    public $user;

    public function __construct($profile, $user)
    {
        $this->profile = $profile;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.new_profiles',[
                    'profiles' =>$this->profile,
                    'user' => $this->user
                ])->subject(__('emailsText.NewProfilesMail_subject'));
    }
}
