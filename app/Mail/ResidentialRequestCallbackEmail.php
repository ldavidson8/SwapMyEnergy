<?php

namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResidentialRequestCallbackEmail extends Mailable
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
        try
        {
            $callbackRequest = $this -> callbackRequest;
            $params = compact([ 'callbackRequest' ]);

            $view = $this -> subject('SwapMyEnergy - Residential Callback Request') -> view('_emails.contact-forms.Residential-request-callback', $params) -> text('_emails.contact-forms.Residential-request-callback-text', $params);
            foreach ($this -> fileUploads as $file)
            {
                $view = $view -> attach(storage_path('app/' . $file -> filename));
            }

            Log::channel('request-callback') -> info('ResidentialRequestCallbackEmail -> build(), Sending Callback Request Email');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('request-callback') -> error('ResidentialRequestCallbackEmail -> build(), Error Sending Callback Request Email  -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}