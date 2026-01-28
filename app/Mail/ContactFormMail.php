<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from($this->data['email'], $this->data['name'])
                    ->subject('Portfolio Contact: ' . $this->data['subject'])
                    ->view('emails.contact')
                    ->with([
                        'contactName' => $this->data['name'],
                        'contactEmail' => $this->data['email'],
                        'contactSubject' => $this->data['subject'],
                        'contactMessage' => $this->data['message'],
                    ]);
    }
}