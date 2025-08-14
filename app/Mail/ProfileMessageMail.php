<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfileMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $link;

    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    public function build()
    {
        
        return $this->view('emails.profile_message',[
                        'userName' => $this->user->like_to_be_called,
                        'link' => $this->link
                    ])->subject(__('emailsText.ProfileMessageMail_subject'));
                    
    }
}
