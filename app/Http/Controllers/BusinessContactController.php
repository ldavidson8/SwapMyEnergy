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
    public function requestCallbackPost(Request $request)
    {
        $successFlags = 0;

        // form validation
        // TODO: restrict file extensions like exe, bat, etc.
        Validator::validate($request -> only([ 'full_name', 'phone_number' ]),
        [
            'full_name' => 'required',
            'phone_number' => 'required'
        ]);
        
        if ($request -> has('email_address') && $request -> input('email_address') != "")
        {
            Validator::validate($request -> only(['email_address']), ['email_address' => 'email']);
        }
        

        // save form details to the database
        try
        {
            $data = 
            [
                'full_name' => $request -> input('full_name'),
                'phone_number' => $request -> input('phone_number')
            ];
            if ($request -> has('email_address')) $data['email_address'] = $request -> input('email_address');
            $callbackRequest = new CallbackRequests($data);
            $callbackRequest -> save();

            $successFlags |= 1;
        }
        catch (Exception $ex)
        {
            // TODO: add error logging
            throw $ex;
        }
        
        
        // save file uploads to the database
        $fileUploads = [];
        if ($request -> hasFile('billsUpload'))
        {
            try
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
                    $fileUploads[] = $callbackRequestFileUpload;
                }

                $successFlags |= 2;
            }
            catch (Exception $ex)
            {
                // TODO: add error logging
                throw $ex;
            }
        }
        
        // --- SQL query to test that the database was updated successfully ---
        // return response() -> json(DB::select(
        //     'SELECT * FROM `callback_requests` as cr INNER JOIN `callback_request_file_uploads` as crfu WHERE cr.id = crfu.file_upload_id AND cr.id=?',
        //     [ $callbackRequest -> id ]
        // ));

        try
        {
            // TODO: send email
            $to_email = env('MAIL_CONTACT_TO_ADDRESS');
            Mail::to($to_email) -> queue(new BusinessRequestCallback($data, $fileUploads));

            $successFlags |= 4;
        }
        catch (Exception $ex)
        {
            // TODO: add error logging
            throw $ex;
        }


        if ($successFlags | 7 == 7)
        {
            // TODO: make delete files successfully
            // TODO: also delete from database or remove filename from record
            foreach ($fileUploads as $file)
            {
                Storage::delete(storage_path('app\\' . $file -> filename));
            }
            return redirect() -> route('business.request callback.success');
        }


        // TODO: redirect based on $successFlags
        return $successFlags;
    }

    public function requestCallbackSuccess()
    {
        return view('request-callback.success');
    }
}