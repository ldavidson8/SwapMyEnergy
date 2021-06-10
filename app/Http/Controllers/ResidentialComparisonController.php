<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class ResidentialComparisonController extends Controller
{
    public function form1()
    {
        ModeSession::setResidential();

        $navbar_page = 'energy-comparison-form';
        $page_title = 'Energy Comparison Form';
        return view('energy-comparison.form-1', compact('navbar_page', 'page_title'));
    }
    
    public function form2()
    {
        ModeSession::setResidential();

        $navbar_page = 'energy-comparison-form';
        $page_title = 'Energy Comparison Form';
        return view('energy-comparison.form-2', compact('navbar_page', 'page_title'));
    }
}