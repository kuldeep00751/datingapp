<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendApproveProfile extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $url;

    /**
     * Create a new message instance.
     *
     * @param  $user
     * @param  $url
     * @return void
     */
    public function __construct($user,$url)
    {
        $this->user = $user;
        $this->url = $url;
    }
    public function build()
    {
        return $this->view('emails.profileApprove',[
            'user' =>$this->user,
            'url' => $this->url
        ])->subject(__('emailsText.SendApproveProfile_subject'));
    }
}
