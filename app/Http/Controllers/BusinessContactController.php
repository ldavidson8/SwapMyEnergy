<?php

namespace App\Http\Controllers;

use App\Mail\BusinessRequestCallback;
use App\Models\CallbackRequests;
use App\Models\CallbackRequestFileUploads;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessContactController extends Controller
{
    public function requestCallback(Request $request)
    {
        // truncate the tables for testing purposes
        DB::select('TRUNCATE TABLE `callback_requests`');
        DB::select('TRUNCATE TABLE `callback_request_file_uploads`');

        // form validation
        Validator::validate($request -> only([ 'full_name', 'phone_number' ]),
        [
            'full_name' => 'required',
            'phone_number' => 'required'
        ]);

        if ($request -> has('email_address') && $request -> input('email_address') != "")
        {
            //Validator::validate($request -> only(['email_address']), ['email_address' => 'email|unique:App\Models\User,email']);
            Validator::validate($request -> only(['email_address']), ['email_address' => 'email']);
        }
        

        // save form details to the database
        $data = 
        [
            'full_name' => $request -> input('full_name'),
            'phone_number' => $request -> input('phone_number')
        ];
        if ($request -> has('email_address')) $data['email_address'] = $request -> input('email_address');
        $callbackRequest = new CallbackRequests($data);
        $callbackRequest -> save();
        
        
        // save file uploads to the database
        if ($request -> hasFile('billsUpload'))
        {
            foreach ($request -> billsUpload as $upload)
            {
                $filename = $upload -> store('uploaded-bills');
                $callbackRequestFileUpload = new CallbackRequestFileUploads(
                    [
                        'file_upload_id' => $callbackRequest -> id,
                        'filename' => $filename
                    ]
                );
                $callbackRequestFileUpload -> save();
            }
        }

        return response() -> json(DB::select(
            'SELECT * FROM `callback_requests` as cr INNER JOIN `callback_request_file_uploads` as crfu WHERE cr.id = crfu.file_upload_id AND cr.id=?',
            [ $callbackRequest -> id ]
        ));

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

        // TODO: redirect
    }
}