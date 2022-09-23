<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $fromAddress)
    {
        $this->name = $name;
        $this->email = $email;
        $this->fromAddress = $fromAddress;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromAddress, 'kamorin\'site')
            ->to($this->email)
            ->subject('【kamorin\'s site】お問い合わせを受付ました')
            ->view('mail')
            ->with('name', $this->name);
    }
}
