<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandleSessions;

class AccountController extends Controller
{
    public function myAccount(Request $request)
    {
        return view('account.my-account', [ 'request' => $request, 'navbar_page' => 'my account' ]);
    }
}