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
        //return view('index.residential', compact('navbar_page', 'page_title'));
        return view('index.residential-coming-soon', compact('navbar_page', 'page_title'));
    }
    
    public function about()
    {
        return redirect() -> route('residential.home');
        
        ModeSession::setResidential();
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy';
        return view('other.about', compact('navbar_page', 'page_title'));
    }
    
    public function privacyPolicy()
    {
        return redirect() -> route('residential.home');
        
        ModeSession::setResidential();

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy';
        return view('other.privacy', compact('navbar_page', 'page_title'));
    }
    
    public function termsAndConditions()
    {
        return redirect() -> route('residential.home');
        
        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions';
        return view('other.t&c', compact('navbar_page', 'page_title'));
    }
    
    public function contact()
    {
        return redirect() -> route('residential.home');
        
        ModeSession::setResidential();

        $navbar_page = 'contact';
        $page_title = 'Contact Us';
        return view('other.contact', compact('navbar_page', 'page_title'));
    }

    public function partnersAndAffiliates()
    {
        return redirect() -> route('residential.home');
        
        ModeSession::setResidential();

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates';
        return view('other.partners-and-affiliates', compact('navbar_page', 'page_title'));
    }

    public function cookiePolicy()
    {
        return redirect() -> route('residential.home');

        ModeSession::setResidential();

        $navbar_page = 'cookie policy';
        $page_title = 'Cookie Policy';
        return view('other.cookie-policy', compact('navbar_page', 'page_title'));
    }
    public function siteMap()
    {
        return redirect() -> route('residential.home');
        
        ModeSession::setResidential();

        $navbar_page = 'sitemap';
        $page_title = 'Sitemap';
        return view('other.sitemap', compact('navbar_page', 'page_title'));
    }
}