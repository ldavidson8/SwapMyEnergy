<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class BusinessWaterEmail extends Mailable
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

            Log::channel('business.water') -> info('BusinessWaterEmail -> build(), Sending Email for Business Water Request');

            $view = $this -> subject('Sending Email for Business Water Request') -> view('_emails.contact-forms.business.water', $params) -> text('_emails.contact-forms.business.water-text', $params);
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('business.water') -> error('BusinessWaterEmail -> build(), Error Sending Email for Business Water Request -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}
