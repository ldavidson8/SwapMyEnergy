<?php

namespace App\Http\Controllers;

use App\Mail\ResidentialRequestCallbackEmail;
use App\Models\CallbackRequests;
use App\Models\CallbackRequestFileUploads;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ResidentialCallbackController extends Controller
{
    public function requestCallbackPost(Request $request)
    {
        $successFlags = 0;

        Log::channel('request-callback') -> info('');
        Log::channel('request-callback') -> info('');
        Log::channel('request-callback') -> info('');

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
        Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Validated Successfully', [ 'successFlags' => $successFlags ]);


        // try catch 1 - save form details to the database
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
            Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Saved form fields to the database', [ 'successFlags' => $successFlags ]);
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('request-callback') -> error('ResidentialCallbackController -> requestCallbackPost(), try catch 1, Error saving form fields to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        }

        // try catch 2 - save file uploads to the database
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
                Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Saved file upload details to the database', [ 'successFlags' => $successFlags ]);
            }
            catch (Throwable $th)
            {
                report($th);
                Log::channel('request-callback') -> error('ResidentialCallbackController -> requestCallbackPost(), try catch 2, Error saving file upload details to the database  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
            }
        }

        // try catch 3 - send email
        try
        {
            $to_email = [ env('MAIL2_TO_ADDRESS') ];
            Mail::to($to_email) -> queue(new ResidentialRequestCallbackEmail($data, $fileUploads));

            $successFlags |= 4;
            Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Sent email containing the callback request', [ 'successFlags' => $successFlags ]);
        }
        catch (Throwable $th)
        {
            report($th);
            Log::channel('request-callback') -> error('ResidentialCallbackController -> requestCallbackPost(), try catch 3, Error sending email containing the callback request  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
        }

        switch ($successFlags)
        {
            case 7:
            case 6:
            case 5:
            case 4:
                // try catch 4 delete files
                try
                {
                    // TODO: make delete files successfully and delete from database or remove filename from record
                    foreach ($fileUploads as $file)
                    {
                        Storage::delete(storage_path('app/' . $file -> filename));
                    }
                }
                catch (\Throwable $th)
                {
                    report($th);
                    Log::channel('request-callback') -> error('ResidentialCallbackController -> requestCallbackPost(), try catch 4, Error deleting uploaded bills  -:-  ' . $th -> getMessage(), [ 'successFlags' => $successFlags ]);
                }
                Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Callback Request Success with attachments', [ 'successFlags' => $successFlags ]);
                return redirect() -> route('residential.request-callback.success');
            default:
                Log::channel('request-callback') -> info('ResidentialCallbackController -> requestCallbackPost(), Callback Request failed', [ 'successFlags' => $successFlags ]);
                return redirect() -> route('residential.request-callback.error');
        }

        abort(500);
    }


    public function requestCallbackSuccess()
    {
        $page_title = 'Request Callback - Swap My Energy';
        return view('contact-forms.request-callback.success', compact('page_title'));
    }

    public function requestCallbackError()
    {
        $page_title = 'Request Callback - Swap My Energy';
        return view('contact-forms.request-callback.error', compact('page_title'));
    }


    // TODO: use this to get client ip address for logging
    // public function getIp(){
    //     foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    //         if (array_key_exists($key, $_SERVER) === true){
    //             foreach (explode(',', $_SERVER[$key]) as $ip){
    //                 $ip = trim($ip); // just to be safe
    //                 if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
    //                     return $ip;
    //                 }
    //             }
    //         }
    //     }
    //     return request()->ip(); // it will return server ip when no client ip found
    // }
}

