<?php

namespace App\Http\Controllers;

use App\Mail\RaiseSupportRequestEmail;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function raiseSupportRequest(Request $request)
    {
        $successFlags = 0;

        Log::channel('raise-support-request') -> info('');
        Log::channel('raise-support-request') -> info('');
        Log::channel('raise-support-request') -> info('');

        // form validation
        $formData = $request -> all();
        $validator = Validator::make($formData,
        [
            'full_name' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'support_issue' => 'required'
        ]);
        if ($validator -> fails()) { return redirect() -> back() -> withErrors($validator) -> withInput(); }
        Log::channel('raise-support-request') -> info('ContactController -> raiseSupportRequest(), Form Validated Successfully', [ 'successFlags' => $successFlags ]);
        

        // try catch 1 - save form details to the database
        // try
        // {
        //     $data = 
        //     [
        //         'full_name' => $request -> input('full_name'),
        //         'phone_number' => $request -> input('phone_number')
        //     ];
        //     if ($request -> has('email_address')) $data['email_address'] = $request -> input('email_address');
        //     $callbackRequest = new CallbackRequests($data);
        //     $callbackRequest -> save();

        //     $successFlags |= 1;
        //     Log::channel('raise-support-request') -> info('ContactController -> raiseSupportRequest(), Saved form fields to the database', [ 'successFlags' => $successFlags ]);
        // }
        // catch (Throwable $th)
        // {
        //     report($th);
        //     Log::channel('raise-support-request') -> error('ContactController -> raiseSupportRequest(), try catch 1, Error saving form fields to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        // }
        
        
        // try catch 2 - send email
        try
        {
            // TODO: generate a ticket which increments
            // generate random string
            $ticket = hash('sha1', time());

            $to_email = [ env('MAIL_TO_ADDRESS') ];
            Mail::to($to_email) -> queue(new RaiseSupportRequestEmail($formData, $ticket));

            $successFlags |= 2;
            Log::channel('raise-support-request') -> info('ContactController -> raiseSupportRequest(), Sent email containing the support request', [ 'successFlags' => $successFlags ]);
            
            return redirect() -> route('business.raise-support-request.success', [ 'ticket' => $ticket ]);
        }
        catch (Throwable $th)
        {
            throw($th);
            report($th);
            Log::channel('raise-support-request') -> error('ContactController -> raiseSupportRequest(), try catch 2, Error sending email containing the support request  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
            return redirect() -> route('business.raise-support-request.error');
        }
    }

    public function raiseSupportRequestSuccess($ticket)
    {
        $page_title = 'Raise Support Request - Swap My Energy';
        return view('contact-forms.raise-support-request.success', compact('page_title', 'ticket'));
    }

    public function raiseSupportRequestError()
    {
        $page_title = 'Raise Support Request - Swap My Energy';
        return view('contact-forms.raise-support-request.error', compact('page_title'));
    }
}