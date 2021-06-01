<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResidentialAccountController extends Controller
{
    public function myAccount(Request $request)
    {
        return redirect() -> route('residential.home');
        $navbar_page = 'my account';
        $page_title = 'My Account';
        $user = Auth::user();
        return view('my-account.residential.index', compact('request', 'navbar_page', 'page_title', 'user'));
    }
    

    public function yourPlan(Request $request)
    {
        return redirect() -> route('residential.home');
        $navbar_page = 'my account';
        $page_title = 'Plan - My Account';
        $user = Auth::user();
        return view('my-account.residential.plan', compact('request', 'navbar_page', 'page_title', 'user'));
    }
    
    public function yourPlanPost(Request $request)
    {
        return redirect() -> route('residential.home');
        // TODO: handle form post

        return redirect() -> route('residential.my account');
    }


    public function yourDetails(Request $request)
    {
        return redirect() -> route('residential.home');
        $navbar_page = 'my account';
        $page_title = 'Details - My Account';
        $user = Auth::user();
        return view('my-account.residential.details', compact('request', 'navbar_page', 'page_title', 'user'));
    }
    
    public function yourDetailsPost(Request $request)
    {
        return redirect() -> route('residential.home');
        $validatedData = $request -> validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'address' => '',
            'phone_number' => '',
            'new_password' => '',
            'password' => 'required'
        ]);
        
        $email = Auth::user() -> email;
        $password = $request -> input('password');
        if (!Auth::validate([ 'email' => $email, 'password' => $password ]))
        {
            return redirect() -> back() -> withInput() -> withErrors([ 'password' => 'Invalid Password.' ]);
        }
        
        $data = [];
        if ($request -> input('full_name') != '') $data['name'] = $request -> input('full_name');
        if ($request -> input('email') != '') $data['email'] = $request -> input('email');
        if ($request -> input('address') != '') $data['address'] = $request -> input('address');
        if ($request -> input('phone_number') != '') $data['phone_number'] = $request -> input('phone_number');
        if ($request -> input('new_password') != '') $data['Password'] = Hash::make($request -> input('new_password'));
        DB::table('users') -> where('email', $email) -> update($data);

        return redirect() -> route('residential.my account');
    }


    public function yourOptions(Request $request)
    {
        return redirect() -> route('residential.home');
        $navbar_page = 'my account';
        $page_title = 'Options - My Account';
        $user = Auth::user();
        return view('my-account.residential.options', compact('request', 'navbar_page', 'page_title', 'user'));
    }
    
    public function yourOptionsPost(Request $request)
    {
        return redirect() -> route('residential.home');
        // TODO: handle form post

        return redirect() -> route('residential.my account');
    }
}