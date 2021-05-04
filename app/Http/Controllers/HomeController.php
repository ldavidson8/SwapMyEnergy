<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandleSessions;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('index', [ 'request' => $request ]);
    }
    
    public function about(Request $request)
    {
        return view('other.about', [ 'request' => $request ]);
    }
    
    public function privacyPolicy(Request $request)
    {
        return view('other.privacy', [ 'request' => $request ]);
    }
    
    public function termsAndConditions(Request $request)
    {
        return view('other.t&c', [ 'request' => $request ]);
    }
    
    public function contactUs(Request $request)
    {
        return view('other.contact-us', [ 'request' => $request ]);
    }
    
    public function support(Request $request)
    {
        return view('other.support', [ 'request' => $request ]);
    }
    
    public function partnersAndAffiliates(Request $request)
    {
        return view('other.partners-and-affiliates', [ 'request' => $request ]);
    }
}