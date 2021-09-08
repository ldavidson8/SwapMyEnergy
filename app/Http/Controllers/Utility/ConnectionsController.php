<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mode\ModeSession;
use App\Mail\ConnectionsRequestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ConnectionsController extends Controller
{
    public function index()
    {
        ModeSession::setBusiness();

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

            // try catch 2 - save file uploads to the database
            try
            {
                DB::select('call Insert_RequestConnection(?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $request -> input('full_name'),
                    $request -> input('phone_number'),
                    $request -> input('email'),
                    ($request -> input('new_customer') == "Y") ? 1 : 0,
                    $request -> input('property_type'),
                    $request -> input('connection_type'),
                    $request -> input('call_back_time'),
                    now()
                ]);

                Log::channel('connections') -> info('ConnectionsController -> connectionsPost(), Saved file upload details to the database', [ '$request -> all()' => $request -> all() ]);
            }
            catch (Throwable $th)
            {
                report($th);
                Log::channel('connections') -> error('ConnectionsController -> connectionsPost(), try catch 2, Error saving file upload details to the database  -:-  ' . $th -> getMessage(), [ '$request -> all()' => $request -> all() ]);
            }

            // send an email to our support email address
            Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new ConnectionsRequestEmail($form_data));

            // redirect to the success page
            return redirect() -> route('connections.success');
        }
        catch (Throwable $th)
        {
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
