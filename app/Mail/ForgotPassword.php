<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this -> user = $user;
        $this -> token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $token = $this -> token;
        $user = $this -> user;

        $link = route('password.reset', compact('token', 'user'));
        $params = compact($link, $user);
        return $this
            -> view('_emails.auth.forgot-password', $params)
            -> text('_emails.auth.forgot-password', $params);
    }
}
