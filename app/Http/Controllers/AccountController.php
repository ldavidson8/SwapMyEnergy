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
    

    public function yourPlan(Request $request)
    {
        return view('my-account.plan', [ 'request' => $request, 'navbar_page' => 'my account', 'user' => Auth::user() ]);
    }
    
    public function yourPlanPost(Request $request)
    {
        // TODO: handle form post
    }


    public function yourDetails(Request $request)
    {
        return view('my-account.details', [ 'request' => $request, 'navbar_page' => 'my account', 'user' => Auth::user() ]);
    }
    
    public function yourDetailsPost(Request $request)
    {
        // TODO: handle form post
    }


    public function yourOptions(Request $request)
    {
        return view('my-account.options', [ 'request' => $request, 'navbar_page' => 'my account', 'user' => Auth::user() ]);
    }
    
    public function yourOptionsPost(Request $request)
    {
        // TODO: handle form post
    }
}