<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $profile;
    public $link;

    public function __construct($profile, $link)
    {
        $this->profile = $profile;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.new_chat_message',[
                    'profile' =>$this->profile,
                    'link' => $this->link
                ])->subject(__('emailsText.NewChatMessage_subject'));
    }
}
