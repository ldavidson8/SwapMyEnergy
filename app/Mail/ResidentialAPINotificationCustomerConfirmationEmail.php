<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResidentialAPINotificationCustomerConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $formData;
    private $result_str;

    public function __construct($formData, $result_str)
    {
        $this -> formData = $formData;
        $this -> result_str = $result_str;
    }


    public function build()
    {
        try
        {
            $user = $this -> formData["user"];
            $result_str = $this -> result_str;
            $params = compact([ 'user', 'result_str' ]);
            
            $view = $this -> subject('Confirmation of your Request to Swap Energy Suppliers')
                -> view('_emails.energy-shop-api.swap-engaged-customer-confirmation', $params)
                -> text('_emails.energy-shop-api.swap-engaged-customer-confirmation-text', $params);
            
            Log::channel('energy-shop-api-swap-engaged') -> info('ResidentialAPINotificationCustomerConfirmationEmail -> build(), Sending Email, The Energy Shop API - Energy Swap Engaged - Customer Confirmation');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('energy-shop-api-swap-engaged') -> error('ResidentialAPINotificationCustomerConfirmationEmail -> build(), Error Sending Email, The Energy Shop API - Energy Swap Engaged - Customer Confirmation  -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}