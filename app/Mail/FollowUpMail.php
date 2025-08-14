<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class FollowUpMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $link;
    public $headingMessage;

    public function __construct($userDetail, $link, $headingMessage)
    {
        $this->user = $userDetail;
        $this->link = $link;
        $this->headingMessage = $headingMessage;
    }

    public function build()
    {
        return $this->view('emails.follow_up_mail',[
                    'user' => $this->user,
                    'link'  =>$this->link,
                    'headingMessage'  =>$this->headingMessage
                ])->subject(__('emailsText.FollowUpMail_subject'));
    }
}