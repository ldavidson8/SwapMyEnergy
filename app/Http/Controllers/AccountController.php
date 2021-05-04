<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandleSessions;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        return view('account.login', [ 'request' => $request, 'navbar_page' => 'login' ]);
    }
    
    public function loginPost(Request $request)
    {
        
    }

    public function logout()
    {
        
    }


    public function registerPost(Request $request)
    {
        
    }


    public function myAccount(Request $request)
    {
        return view('account.my-account', [ 'request' => $request, 'navbar_page' => 'my account' ]);
    }
}