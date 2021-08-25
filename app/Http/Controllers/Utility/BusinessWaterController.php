<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Mail\BusinessWaterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BusinessWaterController extends Controller
{
    public function get()
    {
        $navbar_page = 'utility-water';
        $page_title = 'Business Water Comparison - Swap My Energy';
        return view('utility.business-water', compact('navbar_page', 'page_title'));
    }

    public function post(Request $request)
    {
        try
        {
            // form validation
            $form_data = $request -> all();
            $validator = Validator::make($form_data,
            [
                'full_name' => 'required|string',
                'business_name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'call_back_time' => 'required|string'
            ]);
            if ($validator -> fails()) return back() -> withErrors($validator) -> withInput();

            // send an email to our support email address
            Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new BusinessWaterEmail($form_data));

            // redirect to the success page
            return redirect() -> route('connections.success');
        }
        catch (Throwable $th)
        {
            throw($th);
            report($th);
            return redirect() -> route('connections.error');
        }
    }

    public function success()
    {
        $navbar_page = 'connections';
        $page_title = 'Success | Connections Request Made';
        return view('contact-forms.connections-request.success', compact('page_title', 'navbar_page'));
    }

    public function error()
    {
        $navbar_page = 'connections';
        $page_title = 'Error | Connections Request Failed';
        return view('contact-forms.connections-request.error', compact('page_title', 'navbar_page'));
    }
}
