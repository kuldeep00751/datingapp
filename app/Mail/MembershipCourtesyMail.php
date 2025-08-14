<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipCourtesyMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $link;
    private $messageData;

    public function __construct($user, $link, $messageData)
    {
        $this->user = $user;
        $this->link = $link;
        $this->messageData = $messageData;
    }
    public function build()
    {
        return $this->view('emails.member_courtesy',[
            'user' =>$this->user,
            'link' =>$this->link,
            'messageData' =>$this->messageData

        ])->subject(__('emailsText.MembershipCourtesyMail_subject'));
    }
}
