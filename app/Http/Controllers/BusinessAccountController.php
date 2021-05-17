<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessAccountController extends Controller
{
    public function myAccount(Request $request)
    {
        $navbar_page = 'my account';
        $page_title = 'My Account';
        $user = Auth::user();
        return view('my-account.residential.index', compact('request', 'navbar_page', 'page_title', 'user'));
    }
}