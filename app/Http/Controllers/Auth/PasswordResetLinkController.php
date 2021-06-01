<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $success = $request -> session() -> get('success', false);
        $page_title = 'Forgot Password';
        return view('auth.forgot-password', compact('request', 'page_title', 'success'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([ 'email' => 'required|email' ]);

        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );
    
        // return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);

        $email = $request -> input('email');

        $user = DB::table('users') -> where('email', $email) -> select() -> first();
        if ($user == null)
        {
            return redirect() -> back() -> withInput() -> witherrors([ 'email' => 'That email does not exist' ]);
        }

        $token = STR::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        try
        {
            Mail::to($email) -> queue(new ForgotPassword($user, $token));
            return redirect() -> back() -> with('success', true);
        }
        catch (Exception $ex)
        {
            return redirect() -> back() -> withErrors([ '' => 'Failed to send the email try again later.' ]);
        }
    }
}
