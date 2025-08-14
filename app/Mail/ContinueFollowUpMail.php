<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContinueFollowUpMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    public function __construct($userDetail, $link)
    {
        $this->user = $userDetail;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.continue_follow_up',[
                    'user' => $this->user,
                    'link'  =>$this->link
                ])->subject(__('emailsText.ContinueFollowUpMail_subject'));
    }
}