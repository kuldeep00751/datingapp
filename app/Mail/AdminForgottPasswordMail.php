<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminForgottPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $userAdmin;
    private $resetLink;

    public function __construct($userAdmin, $resetLink)
    {
        $this->userAdmin = $userAdmin;
        $this->resetLink = $resetLink;
    }
    public function build() 
    {
        return $this->view('emails.adminForgotpasswordMail',[
            'userAdmin' =>$this->userAdmin,
            'resetLink' =>$this->resetLink
        ])->subject(__('emailsText.reset_1'));
    }
}
