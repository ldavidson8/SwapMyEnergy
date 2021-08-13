<?php

namespace App\Http\Controllers;

use App\Mail\RaiseSupportRequestEmail;
use App\Mail\PartnerApplyEmail;
use App\Mail\AffiliateApplyEmail;
use App\Models\SupportRequests;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /// ---------------------------------------------
    /// --- raiseSupportRequest(Request $request) ---
    /// ---------------------------------------------
    /// Method: Post
    /// Description: Processes a support request
    public function raiseSupportRequestPost(Request $request)
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
        $ticket = date("dHis");
        try
        {
            $data =
            [
                'full_name' => $request -> input('full_name'),
                'email_address' => $request -> input('email_address'),
                'phone_number' => $request -> input('phone_number'),
                'support_issue' => $request -> input('support_issue')
            ];
            $insertId = DB::table('support_requests') -> insertGetId($data);
            $ticket = $insertId;

            $successFlags |= 1;
            Log::channel('raise-support-request') -> info('ContactController -> raiseSupportRequest(), Saved form fields to the database', [ 'successFlags' => $successFlags ]);
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('raise-support-request') -> error('ContactController -> raiseSupportRequest(), try catch 1, Error saving form fields to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        }
        
        
        // try catch 2 - send email
        try
        {
            // TODO: generate a ticket which increments
            // generate random string

            $to_email = [ env('MAIL_TO_ADDRESS') ];
            Mail::to($to_email) -> queue(new RaiseSupportRequestEmail($formData, $ticket));

            $successFlags |= 2;
            Log::channel('raise-support-request') -> info('ContactController -> raiseSupportRequest(), Sent email containing the support request', [ 'successFlags' => $successFlags ]);
            
            return redirect() -> route('raise-support-request.success', [ 'ticket' => $ticket ]);
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('raise-support-request') -> error('ContactController -> raiseSupportRequest(), try catch 2, Error sending email containing the support request  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
            return redirect() -> route('raise-support-request.error');
        }
    }

    /// -------------------------------------------
    /// --- raiseSupportRequestSuccess($ticket) ---
    /// -------------------------------------------
    /// Method: Get
    /// Description: Displays the support reference number to the user
    public function raiseSupportRequestSuccess($ticket)
    {
        $page_title = 'Raise Support Request - Swap My Energy';
        return view('contact-forms.raise-support-request.success', compact('page_title', 'ticket'));
    }
    
    /// -------------------------------------------
    /// --- raiseSupportRequestError() ---
    /// -------------------------------------------
    /// Method: Get
    /// Description: Tells the user that an error ocurred
    public function raiseSupportRequestError()
    {
        $page_title = 'Raise Support Request - Swap My Energy';
        return view('contact-forms.raise-support-request.error', compact('page_title'));
    }



    /// ---------------------------------------------
    /// --- partnerApplyPost(Request $request) ---
    /// ---------------------------------------------
    /// Method: Post
    /// Description: Processes an application to be a partner
    public function partnerApplyPost(Request $request)
    {
        $successFlags = 0;

        Log::channel('partner-apply') -> info('');
        Log::channel('partner-apply') -> info('');
        Log::channel('partner-apply') -> info('');

        // form validation
        $formData = $request -> all();
        $validatorArray = [
            'full_name' => 'required',
            'email_address' => 'required|email',
            'message' => 'required'
        ];
        $validator = Validator::make($formData, $validatorArray);
        if ($validator -> fails()) { return redirect() -> to(url() -> previous() . "#PartnerApply") -> withInput() -> withErrors($validator, 'partner'); }
        Log::channel('partner-apply') -> info('ContactController -> partnerApplyPost(), Form Validated Successfully', [ 'successFlags' => $successFlags ]);
        

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
        //     Log::channel('partner-apply') -> info('ContactController -> partnerApplyPost(), Saved form fields to the database', [ 'successFlags' => $successFlags ]);
        // }
        // catch (Throwable $th)
        // {
        //     report($th);
        //     Log::channel('partner-apply') -> error('ContactController -> partnerApplyPost(), try catch 1, Error saving form fields to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        // }
        
        
        // try catch 2 - send email
        try
        {
            $to_email = [ env('MAIL_TO_ADDRESS') ];
            Mail::to($to_email) -> queue(new PartnerApplyEmail($formData));

            $successFlags |= 2;
            Log::channel('partner-apply') -> info('ContactController -> partnerApplyPost(), Sent email containing the application to be a partner', [ 'successFlags' => $successFlags ]);
            
            return redirect() -> route('partner-apply.success');
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('partner-apply') -> error('ContactController -> partnerApplyPost(), try catch 2, Error sending email containing the application to be a partner  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
            return redirect() -> route('partner-apply.error');
        }
    }

    /// ------------------------------------
    /// --- raiseSupportRequestSuccess() ---
    /// ------------------------------------
    /// Method: Get
    /// Description: Displays the support reference number to the user
    public function partnerApplySuccess()
    {
        $page_title = 'Partner Application Request - Swap My Energy';
        return view('contact-forms.partner-apply.success', compact('page_title'));
    }
    
    /// ----------------------------------
    /// --- raiseSupportRequestError() ---
    /// ----------------------------------
    /// Method: Get
    /// Description: Tells the user that an error ocurred
    public function partnerApplyError()
    {
        $page_title = 'Partner Application Request - Swap My Energy';
        return view('contact-forms.partner-apply.error', compact('page_title'));
    }



    /// ---------------------------------------------
    /// --- affiliateApplyPost(Request $request) ---
    /// ---------------------------------------------
    /// Method: Post
    /// Description: Processes an application to be an affiliate
    public function affiliateApplyPost(Request $request)
    {
        $successFlags = 0;

        Log::channel('affiliate-apply') -> info('');
        Log::channel('affiliate-apply') -> info('');
        Log::channel('affiliate-apply') -> info('');

        // form validation
        $formData = $request -> all();
        $validatorArray = [
            'full_name' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'type_of_affiliate' => 'required'
        ];
        if ($request -> has('web_link') && $request -> input('web_link') != "") $validatorArray['web_link'] = 'url';
        $validator = Validator::make($formData, $validatorArray);
        if ($validator -> fails()) { return redirect() -> to(url() -> previous() . "#AffiliateApply") -> withInput() -> withErrors($validator, 'affiliate'); }
        Log::channel('affiliate-apply') -> info('ContactController -> affiliateApplyPost(), Form Validated Successfully', [ 'successFlags' => $successFlags ]);
        

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
        //     Log::channel('affiliate-apply') -> info('ContactController -> affiliateApplyPost(), Saved form fields to the database', [ 'successFlags' => $successFlags ]);
        // }
        // catch (Throwable $th)
        // {
        //     report($th);
        //     Log::channel('affiliate-apply') -> error('ContactController -> affiliateApplyPost(), try catch 1, Error saving form fields to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        // }
        
        
        // try catch 2 - send email
        try
        {
            $to_email = [ env('MAIL_TO_ADDRESS') ];
            Mail::to($to_email) -> queue(new AffiliateApplyEmail($formData));

            $successFlags |= 2;
            Log::channel('affiliate-apply') -> info('ContactController -> affiliateApplyPost(), Sent email containing the application to be an affiliate', [ 'successFlags' => $successFlags ]);
            
            return redirect() -> route('affiliate-apply.success');
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('affiliate-apply') -> error('ContactController -> affiliateApplyPost(), try catch 2, Error sending email containing the application to be an affiliate  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
            return redirect() -> route('affiliate-apply.error');
        }
    }

    /// ------------------------------------
    /// --- raiseSupportRequestSuccess() ---
    /// ------------------------------------
    /// Method: Get
    /// Description: Displays the support reference number to the user
    public function affiliateApplySuccess()
    {
        $page_title = 'Affiliate Application Request - Swap My Energy';
        return view('contact-forms.affiliate-apply.success', compact('page_title'));
    }
    
    /// ----------------------------------
    /// --- raiseSupportRequestError() ---
    /// ----------------------------------
    /// Method: Get
    /// Description: Tells the user that an error ocurred
    public function affiliateApplyError()
    {
        $page_title = 'Affiliate Application Request - Swap My Energy';
        return view('contact-forms.affiliate-apply.error', compact('page_title'));
    }

    /// ------------------------------------
    /// --- connectionsPost ---
    /// ------------------------------------
    /// Method: Post
    /// Description: Processes an application to the connections service
    // public function connectionsPost()
    // {
    //     try
    //     {
    //         // form validation
    //         $form_data = Request::all();
    //         $validator = Validator::make($form_data,
    //         [
    //             'full_name' => 'required|string',
    //             'email' => 'required|email',
    //             'phone' => 'nullable|numeric',
    //             'message' => 'required|string',
    //             'services' => 'nullable|array'
    //         ]);
    //         if ($validator -> fails()) return back() -> withErrors($validator) -> withInput();
            
    //         // send an email to our support email address
    //         Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new ServiceSelectionEmail($form_data), $ticket);

    //         // redirect to the success page
    //         return redirect() -> route('post.service-selection.success', [ "ticket" => $ticket ]);
    //     }
    //     catch (Throwable $th)
    //     {
    //         report($th);
    //         return redirect() -> route('post.service-selection.error');
    //     }
    // }

    // public function serviceSelectionSuccess($ticket)
    // {
    //     $page_title = 'Success | Gigawaffle Service Request';
    //     return view('contact-forms.service-selection.success', compact('page_title', 'ticket'));
    // }

    // public function serviceSelectionError()
    // {
    //     $page_title = 'Error | Gigawaffle Service Request';
    //     return view('contact-forms.service-selection.error', compact('page_title'));
    // }
}