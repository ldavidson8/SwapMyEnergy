<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResidentialAPINotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $formData;
    private $dateTime;
    private $api_key_used;
    private $result_str;

    public function __construct($formData, $dateTime, $api_key_used, $result_str)
    {
        $this -> formData = $formData;
        $this -> dateTime = $dateTime;
        $this -> api_key_used = $api_key_used;
        $this -> result_str = $result_str;
    }


    public function build()
    {
        try
        {
            $user = $this -> formData["user"];
            $payment = $this -> formData["payment"];
            $dateTime = $this -> dateTime;
            $api_key_used = $this -> api_key_used;
            $result_str = $this -> result_str;
            $params = compact([ 'user', 'payment', 'dateTime', 'api_key_used', 'result_str' ]);
            
            $view = $this -> subject('The Energy Shop API - Energy Swap Engaged') -> view('_emails.energy-shop-api.swap-engaged', $params) -> text('_emails.energy-shop-api.swap-engaged-text', $params);
            
            Log::channel('energy-shop-api-swap-engaged') -> info('ResidentialAPINotificationEmail -> build(), Sending Email, The Energy Shop API - Energy Swap Engaged');
            return $view;
        }
        catch (Throwable $ex)
        {
            report($ex);
            Log::channel('energy-shop-api-swap-engaged') -> error('ResidentialAPINotificationEmail -> build(), Error Sending Email, The Energy Shop API - Energy Swap Engaged  -:-  ' . $ex -> getMessage());
            abort(500);
        }
    }
}