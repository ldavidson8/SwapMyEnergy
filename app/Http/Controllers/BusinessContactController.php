<?php

namespace App\Http\Controllers;

use App\Mail\BusinessRequestCallback;
use App\Models\CallbackRequests;
use App\Models\CallbackRequestFileUploads;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BusinessContactController extends Controller
{
    public function requestCallback(Request $request)
    {
        Validator::validate($request -> only([ 'full_name', 'phone_number' ]),
        [
            'full_name' => 'required',
            'phone_number' => 'required'
        ]);

        if ($request -> has('email') && $request -> input('email') != "")
        {
            Validator::validate($request -> only([ 'email' ]), [ 'email' => 'email|unique:App\Models\User,email' ]);
        }

        $request_params = $request -> all();
        if (!isset($request_params['email'])) $request_params['email'] = "";

        if ($request -> has('billsUpload'))
        {
            $files = $request -> file('billsUpload');
            foreach ($files as $file)
            {
                $filename = $file -> getClientOriginalName();
                $callbackRequest = CallbackRequests::create();
                foreach ($request -> billsUpload as $upload)
                {
                    $filename = $upload -> store('uploaded-bills');
                    CallbackRequestFileUploads::create(
                    [
                        'file_upload_id' => $files -> id,
                        'filename' => $filename
                    ]);
                }
            }
        }

        $to_email = env('MAIL_CONTACT_TO_ADDRESS');
        
        try
        {
            // TODO: send email
            //Mail::to($to_email) -> queue(new BusinessRequestCallback());
            //return redirect() -> back() -> with('success', true);
        }
        catch (Exception $ex)
        {
            // TODO: add error logging
            //return redirect() -> back() -> withErrors([ '' => 'Failed to send the email try again later.' ]);
        }

        try
        {
            // TODO: save details to database
        }
        catch (Exception $ex)
        {
            // TODO: add error logging
        }

        // TODO: redirect
    }
}