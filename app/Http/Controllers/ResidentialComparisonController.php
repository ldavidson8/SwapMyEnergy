<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;
use Illuminate\Http\Request;

class ResidentialComparisonController extends Controller
{
    public function index(Request $request)
    {
        ModeSession::setResidential($request);

        $navbar_page = 'energy-comparison';
        $page_title = 'Compare Energy';
        return view('energy-comparison.index', compact('request', 'navbar_page', 'page_title'));
    }
}