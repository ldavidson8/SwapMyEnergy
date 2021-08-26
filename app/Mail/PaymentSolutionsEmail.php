<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentSolutionsEmail extends Mailable
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

            Log::channel('payment-solutions') -> info('PaymentSolutionsEmail -> build(), Sending Request for Payment Solutions Request');

            $view = $this -> subject('Payment Solutions Request') -> view('_emails.contact-forms.payment-solutions', $params) -> text('_emails.contact-forms.payment-solutions-text', $params);
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('payment-solutions') -> error('PaymentSolutionsEmail -> build(), Error Sending Request for Payment Solutions Request -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}
