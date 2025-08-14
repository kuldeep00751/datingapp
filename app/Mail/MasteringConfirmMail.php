<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MasteringConfirmMail extends Mailable implements ShouldQueue
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
        return $this->view('emails.mastering_confirm',[
                    'profiles' =>$this->profile,
                    'user' => $this->user
                ])->subject($this->user->like_to_be_called . ' ' . __('emailsText.MasteringConfirmMail_subject'));
    }
}