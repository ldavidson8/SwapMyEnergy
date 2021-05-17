<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;
use Illuminate\Http\Request;

class ResidentialHomeController extends Controller
{
    public function index(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'home';
        $page_title = 'Swap My Energy - Home';
        return view('index.residential', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function about(Request $request)
    {
        ModeSession::setResidential($request);
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy';
        return view('other.about', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function privacyPolicy(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy';
        return view('other.privacy', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function termsAndConditions(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions';
        return view('other.t&c', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function support(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'support';
        $page_title = 'Contact/Support';
        return view('other.support', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function partnersAndAffiliates(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates';
        return view('other.partners-and-affiliates', compact('request', 'navbar_page', 'page_title'));
    }
}