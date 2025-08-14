<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MasteringMail1 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile;
    public $user;

    public function __construct($acceptUserId, $userDetail)
    {
        $this->profile = $acceptUserId;
        $this->user = $userDetail;
    }

    public function build()
    {
        return $this->view('emails.mastering',[
                    'profiles' =>$this->profile,
                    'user' => $this->user
                ])->subject(__('emailsText.MasteringMail1_subject'));
    }
}