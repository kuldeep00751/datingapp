<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class KnowingMoreTime extends Mailable implements ShouldQueue
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
        return $this->view('emails.knowing_more_time',[
                    'user' => $this->user,
                    'link' => $this->link
                ])->subject(__('emailsText.KnowingMoreTime_subject'));
    }
}