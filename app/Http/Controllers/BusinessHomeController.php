<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class BusinessHomeController extends Controller
{
    public function index()
    {
        ModeSession::setBusiness();

        $navbar_page = 'home';
        $page_title = 'Swap My Energy - Home';
        return view('index.business', compact('navbar_page', 'page_title'));
    }
    
    public function about()
    {
        ModeSession::setBusiness();
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy';
        return view('other.about', compact('navbar_page', 'page_title'));
    }
    
    public function privacyPolicy()
    {
        ModeSession::setBusiness();

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy';
        return view('other.privacy', compact('navbar_page', 'page_title'));
    }
    
    public function termsAndConditions()
    {
        ModeSession::setBusiness();

        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions';
        return view('other.t&c', compact('navbar_page', 'page_title'));
    }
    
    public function contact()
    {
        ModeSession::setBusiness();

        $navbar_page = 'contact';
        $page_title = 'Contact Us';
        return view('other.contact', compact('navbar_page', 'page_title'));
    }
    
    public function partnersAndAffiliates()
    {
        ModeSession::setBusiness();

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates';
        return view('other.partners-and-affiliates', compact('navbar_page', 'page_title'));
    }

    public function cookiePolicy()
    {
        ModeSession::setBusiness();

        $navbar_page = 'cookie policy';
        $page_title = 'Cookie Policy';
        return view('other.cookie-policy', compact('navbar_page', 'page_title'));
    }
    
    public function siteMap()
    {
        ModeSession::setBusiness();

        $navbar_page = 'sitemap';
        $page_title = 'Sitemap';
        return view('other.sitemap', compact('navbar_page', 'page_title'));
    }

    public function ourTeam()
    {
        ModeSession::setBusiness();

        $navbar_page = 'our team';
        $page_title = 'Our Team';
        return view('other.our-team', compact('navbar_page', 'page_title'));
    }

    public function connections()
    {
        ModeSession::setBusiness();

        $navbar_page = 'connections';
        $page_title = 'Connections';
        return view('index.connections', compact('navbar_page', 'page_title'));
    }
}