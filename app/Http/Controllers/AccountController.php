<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandleSessions;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        return view('account.login', [ 'request' => $request ]);
    }
    
    public function loginPost(Request $request)
    {
        
    }

    public function logout()
    {

    }


    public function signUp(Request $request)
    {
        return view('account.sign-up', [ 'request' => $request ]);
    }
        
    public function signUpPost()
    {
        
    }


    public function myAccount(Request $request)
    {
        $mode = HandleSessions::GetMode($request);
        return view('account.my-account', [ 'request' => $request ]);
    }
}