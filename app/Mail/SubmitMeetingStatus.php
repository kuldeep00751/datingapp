<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SubmitMeetingStatus extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($userDetail)
    {
        $this->user = $userDetail;
    }

    public function build()
    {
        return $this->view('emails.submit_meeting_status',[
                    'user' => $this->user
                ])->subject(__('emailsText.SubmitMeetingStatus_subject'));
    }
}