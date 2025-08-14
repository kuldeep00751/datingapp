<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderExpiredProfilesMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile;
    public $user;

    public function __construct($profile, $user)
    {
        $this->profile = $profile;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.reminder_profiles_expired', [
            'profile' => $this->profile,
            'user' => $this->user,
        ])->subject(__('emailsText.ReminderExpiredProfilesMail_subject'));
    }
}

