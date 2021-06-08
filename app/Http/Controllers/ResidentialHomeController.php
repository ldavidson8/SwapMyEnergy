<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class ResidentialHomeController extends Controller
{
    public function index()
    {
        ModeSession::setResidential();

        $navbar_page = 'home';
        $page_title = 'Swap My Energy - Home';
        return view('index.residential', compact('navbar_page', 'page_title'));
        //return view('index.residential-coming-soon', compact('navbar_page', 'page_title'));
    }
    
    public function about()
    {
        ModeSession::setResidential();
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy';
        return view('other.about', compact('navbar_page', 'page_title'));
    }
    
    public function privacyPolicy()
    {
        ModeSession::setResidential();

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy';
        return view('other.privacy', compact('navbar_page', 'page_title'));
    }
    
    public function termsAndConditions()
    {
        ModeSession::setResidential();

        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions';
        return view('other.t&c', compact('navbar_page', 'page_title'));
    }
    
    public function contact()
    {
        ModeSession::setResidential();

        $navbar_page = 'contact';
        $page_title = 'Contact Us';
        return view('other.contact', compact('navbar_page', 'page_title'));
    }

    public function partnersAndAffiliates()
    {
        ModeSession::setResidential();

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates';
        return view('other.partners-and-affiliates', compact('navbar_page', 'page_title'));
    }
}