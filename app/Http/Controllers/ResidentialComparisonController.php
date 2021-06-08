<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class ResidentialComparisonController extends Controller
{
    public function index()
    {
        ModeSession::setResidential();

        $navbar_page = 'energy-comparison';
        $page_title = 'Compare Energy';
        return view('energy-comparison.index', compact('navbar_page', 'page_title'));
    }
}