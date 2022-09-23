<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorAuthPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $tfa_token = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tfa_token, $email, $name)
    {
        $this->tfa_token = $tfa_token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, 'kamorin\'site')
            ->to($this->email)
            ->subject('【kamorin\'s site】２要素認証のパスワード')
            ->view('password')
            ->with('tfa_token', $this->tfa_token)
            ->with('name', $this->name);
    }
}
