<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BusinessRequestCallback extends Mailable
{
    use Queueable, SerializesModels;


    private $callbackRequest;
    private $fileUploads;
    

    public function __construct($callbackRequest, $fileUploads)
    {
        $this -> callbackRequest = $callbackRequest;
        $this -> fileUploads = $fileUploads;
    }


    public function build()
    {
        $callbackRequest = $this -> callbackRequest;
        $params = compact([ 'callbackRequest' ]);

        $view = $this -> view('_emails.contact.business-request-callback', $params) -> text('_emails.contact.business-request-callback-text', $params);
        foreach ($this -> fileUploads as $file)
        {
            $view = $view -> attach(storage_path('app\\' . $file -> filename));
        }

        return $view;
    }
}