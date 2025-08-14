<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceivedComment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $profile;
    private $user;
    private $link;

    public function __construct($profile, $Users, $link)
    {
        $this->profile = $profile;
        $this->user = $Users;
        $this->link = $link;
    }
    public function build()
    {
        return $this->view('emails.comment_receive',[
            'profile' =>$this->profile,
            'user' =>$this->user,
            'link' =>$this->link

        ])->subject(__('emailsText.ReceivedComment_subject'));
    }
}
