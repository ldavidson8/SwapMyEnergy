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
        return view('index.residential-coming-soon', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function about(Request $request)
    {
        return redirect() -> route('residential.home');
        ModeSession::setResidential($request);
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy';
        return view('other.about', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function privacyPolicy(Request $request)
    {
        return redirect() -> route('residential.home');
        ModeSession::setResidential($request);

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy';
        return view('other.privacy', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function termsAndConditions(Request $request)
    {
        return redirect() -> route('residential.home');
        ModeSession::setResidential($request);

        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions';
        return view('other.t&c', compact('request', 'navbar_page', 'page_title'));
    }
    
    public function contact(Request $request)
    {
        return redirect() -> route('residential.home');
        ModeSession::setResidential($request);

        $navbar_page = 'contact';
        $page_title = 'Contact Us';
        return view('other.contact', compact('request', 'navbar_page', 'page_title'));
    }

    public function contactPost(Request $request)
    {
        return redirect() -> route('residential.home');
        // TODO: handle the request object
        return redirect() -> back() -> withInput();
    }
    
    public function partnersAndAffiliates(Request $request)
    {
        return redirect() -> route('residential.home');
        ModeSession::setResidential($request);

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates';
        return view('other.partners-and-affiliates', compact('request', 'navbar_page', 'page_title'));
    }
}