<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptInvitationMail extends Mailable implements ShouldQueue
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
        return $this->view('emails.accept_invitation',[
                    'profilesEmail' =>$this->profile->email,
                    'profilesName' =>$this->profile->like_to_be_called,
                    'userName' => $this->user->like_to_be_called,
                    'user_id'=> $this->user->id
                ])->subject($this->user->like_to_be_called . ' ' . __('emailsText.AcceptInvitationMail_subject'));

    }
}
