<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ConnectionsRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $formData;

    public function __construct($formData)
    {
        $this -> formData = $formData;
    }

    public function build()
    {
        try
        {
            $formData = $this -> formData;
            $params = compact([ 'formData' ]);

            Log::channel('connections') -> info('ConnectionsRequestEmail -> build(), Sending Request for Connections Request');

            $view = $this -> subject('Connections Request') -> view('_emails.contact-forms.connections-request', $params) -> text('_emails.contact-forms.connections-request-text', $params);
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('connections') -> error('ConnectionsRequestEmail -> build(), Error Sending Request for Connections Request -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}
