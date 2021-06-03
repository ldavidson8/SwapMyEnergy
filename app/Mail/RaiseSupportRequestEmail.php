<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class RaiseSupportRequestEmail extends Mailable
{
    use Queueable, SerializesModels;


    private $formData;
    private $ticket;
    

    public function __construct($formData, $ticket)
    {
        $this -> formData = $formData;
        $this -> ticket = $ticket;
    }


    public function build()
    {
        try
        {
            $formData = $this -> formData;
            $ticket = $this -> ticket;
            $params = compact([ 'formData', 'ticket' ]);

            $view = $this -> subject('SwapMyEnergy - Support Request') -> view('_emails.contact-forms.raise-support-request', $params) -> text('_emails.contact-forms.raise-support-request-text', $params);
            
            Log::channel('request-callback') -> info('RaiseSupportRequestEmail -> build(), Sending Raise Support Request Email');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('request-callback') -> error('RaiseSupportRequestEmail -> build(), Error Sending Raise Support Request Email -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}