<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class AffiliateApplyEmail extends Mailable
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

            $view = $this -> subject('SwapMyEnergy - Application to be an Affiliate') -> view('_emails.contact-forms.affiliate-apply', $params) -> text('_emails.contact-forms.affiliate-apply-text', $params);
            
            Log::channel('affiliate-apply') -> info('AffiliateApplyEmail -> build(), Sending Email, Application to be an Affiliate');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('affiliate-apply') -> error('AffiliateApplyEmail -> build(), Error Sending Email, Application to be an Affiliate  -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}