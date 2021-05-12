<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandleSessions;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('index', [ 'request' => $request, 'navbar_page' => "home", 'page_title' => 'Swap My Energy - Home' ]);
    }
    
    public function about(Request $request)
    {
        return view('other.about', [ 'request' => $request, 'navbar_page' => "about", 'page_title' => 'About Swap My Energy' ]);
    }
    
    public function privacyPolicy(Request $request)
    {
        return view('other.privacy', [ 'request' => $request, 'navbar_page' => "privacy policy", 'page_title' => 'Privacy Policy' ]);
    }
    
    public function termsAndConditions(Request $request)
    {
        return view('other.t&c', [ 'request' => $request, 'navbar_page' => 'terms and conditions' ]);
    }
    
    public function support(Request $request)
    {
        return view('other.support', [ 'request' => $request, 'navbar_page' => "support", 'page_title' => 'Contact/Support' ]);
    }
    
    public function partnersAndAffiliates(Request $request)
    {
        return view('other.partners-and-affiliates', [ 'request' => $request, 'navbar_page' => "partners and affiliates", 'page_title' => 'Partners and Affiliates' ]);
    }
}