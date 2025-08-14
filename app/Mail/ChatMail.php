<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChatMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile;
    public $link;

    public function __construct($profileData, $linkData)
    {
        $this->profile = $profileData;
        $this->link = $linkData;
    }

    public function build()
    {
        return $this->subject(__('emailsText.ChatMail_subject'))
                ->view('emails.chat_mail')
                ->with([
                    'profile' =>$this->profile,
                    'link' => $this->link
                ]);
    }
}
