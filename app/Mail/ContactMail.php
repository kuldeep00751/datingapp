<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data, $attachmentPath = null)
    {
        $this->data = $data;
        $this->attachmentPath = $attachmentPath;
    }

    public function build()
    {
        $email =  $this->subject(__('emailsText.ContactMail_subject'))
                    ->view('emails.contact')
                    ->with('data', $this->data);

            if ($this->attachmentPath) {
                $email->attach(storage_path("app/public/" . $this->attachmentPath));
            }

        return $email;
    }
}
