<?php

namespace App\Http\Controllers;

use App\Models\HandleSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function myAccount(Request $request)
    {
        return view('my-account.index', [ 'request' => $request, 'navbar_page' => 'my account', 'user' => Auth::user() ]);
    }

    public function yourDetails()
    {
        return view('my-account.details');
    }

    public function yourDetailsPost(Request $request)
    {
        // TODO: handle form post
    }
}