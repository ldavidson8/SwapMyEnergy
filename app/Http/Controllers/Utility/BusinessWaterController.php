<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mode\ModeSession;
use App\Mail\BusinessWaterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BusinessWaterController extends Controller
{
    public function get()
    {
        $navbar_page = 'business-water';
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
                'phone_number' => 'nullable|string',
                'email' => 'required|email',
                'call_back_time' => 'required|string'
            ]);
            if ($validator -> fails()) return back() -> withErrors($validator) -> withInput();

            // try catch 2 - save file uploads to the database
            try
            {
                DB::select('call Insert_RequestBusinessWater(?, ?, ?, ?, ?, ?)',
                [
                    $request -> input('full_name'),
                    $request -> input('business_name'),
                    $request -> input('email'),
                    $request -> input('phone_number'),
                    $request -> input('call_back_time'),
                    now()
                ]);

                Log::channel('business-water') -> info('ConnectionsController -> connectionsPost(), Saved file upload details to the database', [ '$request -> all()' => $request -> all() ]);
            }
            catch (Throwable $th)
            {
                throw($th);
                report($th);
                Log::channel('business-water') -> error('ConnectionsController -> connectionsPost(), try catch 2, Error saving file upload details to the database  -:-  ' . $th -> getMessage(), [ '$request -> all()' => $request -> all() ]);
            }

            // send an email to our support email address
            Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new BusinessWaterEmail($form_data));

            // redirect to the success page
            return redirect() -> route('business.water.success');
        }
        catch (Throwable $th)
        {
            throw($th);
            report($th);
            return redirect() -> route('business.water.error');
        }
    }

    public function success()
    {
        $navbar_page = 'business-water';
        $page_title = 'Success - Business Water Form - SwapMyEnergy';
        return view('contact-forms.business-water.success', compact('page_title', 'navbar_page'));
    }

    public function error()
    {
        $navbar_page = 'business-water';
        $page_title = 'Error | Business Water Form - SwapMyEnergy';
        return view('contact-forms.business-water.error', compact('page_title', 'navbar_page'));
    }
}
