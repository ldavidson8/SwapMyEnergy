<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function create()
    {
        $page_title = 'Reset Password - Swap My Energy';
        return view('auth.change-password', compact('page_title'));
    }

    public function store(Request $request)
    {
        $request -> validate([
            'password' => 'required|string|confirmed|min:8'
        ]);

        $user = Auth::user();
        $user -> password = Hash::make($request -> input('password'));
        $user -> save();

        return redirect() -> route('change-password.success');
    }
}
