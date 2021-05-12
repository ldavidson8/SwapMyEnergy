<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function myAccount(Request $request)
    {
        return view('my-account.index',
        [
            'request' => $request,
            'navbar_page' => 'my account',
            'page_title' => 'My Account',
            'user' => Auth::user()
        ]);
    }
    

    public function yourPlan(Request $request)
    {
        return view('my-account.plan',
        [
            'request' => $request,
            'navbar_page' => 'my account',
            'page_title' => 'Plan - My Account',
            'user' => Auth::user()
        ]);
    }
    
    public function yourPlanPost(Request $request)
    {
        // TODO: handle form post

        return redirect() -> route('my account');
    }


    public function yourDetails(Request $request)
    {
        return view('my-account.details',
        [
            'request' => $request,
            'navbar_page' => 'my account',
            'page_title' => 'Details - My Account',
            'user' => Auth::user()
        ]);
    }
    
    public function yourDetailsPost(Request $request)
    {
        $validatedData = $request -> validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone_number' => 'required',
            'new_password' => '',
            'password' => 'required'
        ]);
        
        $email = Auth::user() -> email;
        $password = $request -> input('password');
        if (!Auth::validate([ 'email' => $email, 'password' => $password ]))
        {
            return redirect() -> back() -> withErrors([ 'password' => 'Invalid Password.' ]);
        }
        
        $data = [];
        if ($request -> input('name') != '') $data['name'] = $request -> input('full_name');
        if ($request -> input('email') != '') $data['email'] = $request -> input('email');
        if ($request -> input('address') != '') $data['address'] = $request -> input('address');
        if ($request -> input('phone_number') != '') $data['phone_number'] = $request -> input('phone_number');
        if ($request -> input('new_password') != '') $data['Password'] = Hash::make($request -> input('new_password'));
        DB::table('users') -> where('email', $email) -> update($data);

        return redirect() -> route('my account');
    }


    public function yourOptions(Request $request)
    {
        return view('my-account.options',
        [
            'request' => $request,
            'navbar_page' => 'my account',
            'page_title' => 'Options - My Account',
            'user' => Auth::user()
        ]);
    }
    
    public function yourOptionsPost(Request $request)
    {
        // TODO: handle form post

        return redirect() -> route('my account');
    }
}