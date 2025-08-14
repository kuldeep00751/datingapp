<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipPaused extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $user;
    private $link;
    private $pausedUntil;

    public function __construct($user, $link, $pausedUntil)
    {
        $this->user = $user;
        $this->link = $link;
        $this->pausedUntil = $pausedUntil;
    }
    public function build()
    {
        return $this->view('emails.membership_paused',[
            'user' =>$this->user,
            'link' =>$this->link,
            'pausedUntil' =>$this->pausedUntil
        ])->subject(__('emailsText.MembershipPaused_subject'));
    }
}