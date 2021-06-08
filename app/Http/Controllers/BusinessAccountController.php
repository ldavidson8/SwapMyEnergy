<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BusinessAccountController extends Controller
{
    public function myAccount()
    {
        $navbar_page = 'my account';
        $page_title = 'My Account';
        $user = Auth::user();
        return view('my-account.business.index', compact('navbar_page', 'page_title', 'user'));
    }
}