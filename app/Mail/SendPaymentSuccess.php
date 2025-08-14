<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPaymentSuccess extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $startdate;
    public $enddate;

    public function __construct($user, $startdate, $enddate)
    {
        $this->user = $user;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    public function build()
    {
        return $this->view('emails.send_payment_success',[
                    'user' => $this->user,
                    'startdate' =>$this->startdate,
                    'enddate' =>$this->enddate,
                ])->subject(__('emailsText.successPayment_subject'));
    }
}
