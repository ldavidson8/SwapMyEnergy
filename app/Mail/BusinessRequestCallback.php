<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessRequestCallback extends Mailable
{
    use Queueable, SerializesModels;


    // variables go here


    public function __construct()
    {
        
    }


    public function build()
    {
        $params = [];

        return $this -> view('_emails.contact.business-request-callback', $params) -> text('_emails.contact.business-request-callback-text', $params);
    }
}