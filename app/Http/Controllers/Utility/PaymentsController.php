<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mode\ModeSession;
use App\Mail\PaymentSolutionsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PaymentsController extends Controller
{
    public function index()
    {
        ModeSession::setBusiness();

        $navbar_page = 'payment-solutions';
        $page_title = 'Swap My Energy - Payment Solutions';
        return view('utility.payment-solutions', compact('navbar_page', 'page_title'));
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
                'email' => 'required|email',
                'phone_number' => 'nullable|string',
            ]);
            if ($validator -> fails()) return back() -> withErrors($validator) -> withInput();

            // send an email to our support email address
            Mail::to(env('MAIL_TO_ADDRESS')) -> queue(new PaymentSolutionsEmail($form_data));

            // try catch 2 - save file uploads to the database
            try
            {
                DB::select('call Insert_RequestPaymentSolutions(?, ?, ?, ?)',
                [
                    $request -> input('full_name'),
                    $request -> input('email'),
                    $request -> input('phone_number'),
                    now()
                ]);

                Log::channel('payment-solutions') -> info('ConnectionsController -> connectionsPost(), Saved file upload details to the database', [ '$request -> all()' => $request -> all() ]);
            }
            catch (Throwable $th)
            {
                report($th);
                Log::channel('payment-solutions') -> error('ConnectionsController -> connectionsPost(), try catch 2, Error saving file upload details to the database  -:-  ' . $th -> getMessage(), [ '$request -> all()' => $request -> all() ]);
            }

            // redirect to the success page
            return redirect() -> route('payment-solutions.success');
        }
        catch (Throwable $th)
        {
            report($th);
            return redirect() -> route('payment-solutions.error');
        }
    }

    public function success()
    {
        $navbar_page = 'utility-payment-solutions';
        $page_title = 'Success - Payment Solutions Form - SwapMyEnergy';
        return view('contact-forms.payment-solutions.success', compact('page_title', 'navbar_page'));
    }

    public function error()
    {
        $navbar_page = 'utility-payment-solutions';
        $page_title = 'Error | Payment Solutions Form - SwapMyEnergy';
        return view('contact-forms.payment-solutions.error', compact('page_title', 'navbar_page'));
    }
}
