<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $link;
    public $user;

    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.payment_reminder',[
                    'user' => $this->user,
                    'link' =>$this->link,
                ])->subject(__('emailsText.PaymentReminderEmail_subject').' 🚀');
    }
}
