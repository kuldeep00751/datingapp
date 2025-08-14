<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipCancelled extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $link;

    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;

    }
    public function build()
    {
        return $this->view('emails.member_cancelled',[
            'user' =>$this->user,
            'link' =>$this->link

        ])->subject(__('emailsText.MembershipCancelled_subject'));
    }
}
