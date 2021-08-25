<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Mail\ConnectionsRequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ConnectionsController extends Controller
{
    public function index()
    {
        $navbar_page = 'connections';
        $page_title = 'Swap My Energy - Connections';
        return view('utility.connections', compact('navbar_page', 'page_title'));
    }

    /// ---------------------------
    /// ----- connectionsPost -----
    /// ---------------------------
    /// Method: Post
    /// Description: Processes an application to the connections service
    public function connectionsPost(Request $request)
    {
        try
        {
            // form validation
            $form_data = $request -> all();
            $validator = Validator::make($form_data,
            [
                'full_name' => 'required|string',
                'phone_number' => 'required',
                'email' => 'required|email',
                'new_customer' => 'required|in:Y,N',
                'property_type' => 'required|string',
                'connection_type' => 'required|string',
                'call_back_time' => 'required|string'
            ]);
            if ($validator -> fails()) return back() -> withErrors($validator) -> withInput();

            // send an email to our support email address
            Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new ConnectionsRequestEmail($form_data));

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

    public function connectionsSuccess()
    {
        $navbar_page = 'connections';
        $page_title = 'Success | Connections Request Made';
        return view('contact-forms.connections-request.success', compact('page_title', 'navbar_page'));
    }

    public function connectionsError()
    {
        $navbar_page = 'connections';
        $page_title = 'Error | Connections Request Failed';
        return view('contact-forms.connections-request.error', compact('page_title', 'navbar_page'));
    }
}
