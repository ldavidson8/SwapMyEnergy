<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class PartnerApplyEmail extends Mailable
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

            $view = $this -> subject('SwapMyEnergy - Application to be a Partner') -> view('_emails.contact-forms.partner-apply', $params) -> text('_emails.contact-forms.partner-apply-text', $params);
            
            Log::channel('partner-apply') -> info('PartnerApplyEmail -> build(), Sent Email, Application to be a Partner');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('partner-apply') -> error('PartnerApplyEmail -> build(), Error Sending Email, Application to be a Partner  -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}