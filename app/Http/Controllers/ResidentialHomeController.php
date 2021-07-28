<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class ResidentialHomeController extends Controller
{
    public function index()
    {
        ModeSession::setResidential();

        $navbar_page = 'home';
        $page_title = 'Swap My Energy - Residential';
        return view('index.residential', compact('navbar_page', 'page_title'));
        //return view('index.residential-coming-soon', compact('navbar_page', 'page_title'));
    }
    
    public function about()
    {
        ModeSession::setResidential();
        
        $navbar_page = 'about';
        $page_title = 'About Swap My Energy - Residential';
        return view('other.about', compact('navbar_page', 'page_title'));
    }
    
    public function privacyPolicy()
    {
        ModeSession::setResidential();

        $navbar_page = 'privacy policy';
        $page_title = 'Privacy Policy - Residential';
        return view('other.privacy', compact('navbar_page', 'page_title'));
    }
    
    public function termsAndConditions()
    {
        ModeSession::setResidential();

        $navbar_page = 'terms and conditions';
        $page_title = 'Terms and Conditions - Residential';
        return view('other.t&c', compact('navbar_page', 'page_title'));
    }
    
    public function contact()
    {
        ModeSession::setResidential();

        $navbar_page = 'contact';
        $page_title = 'Contact Us - Residential';
        return view('other.contact', compact('navbar_page', 'page_title'));
    }

    public function partnersAndAffiliates()
    {
        ModeSession::setResidential();

        $navbar_page = 'partners and affiliates';
        $page_title = 'Partners and Affiliates - Residential';
        return view('other.partners-and-affiliates', compact('navbar_page', 'page_title'));
    }

    public function cookiePolicy()
    {
        ModeSession::setResidential();

        $navbar_page = 'cookie policy';
        $page_title = 'Cookie Policy - Residential';
        return view('other.cookie-policy', compact('navbar_page', 'page_title'));
    }

    public function siteMap()
    {
        ModeSession::setResidential();

        $navbar_page = 'sitemap';
        $page_title = 'Sitemap - Residential';
        return view('other.sitemap', compact('navbar_page', 'page_title'));
    }

    public function ourTeam()
    {
        ModeSession::setBusiness();

        $navbar_page = 'our team';
        $page_title = 'Our Team - Residential';
        return view('other.our-team', compact('navbar_page', 'page_title'));
    }
}