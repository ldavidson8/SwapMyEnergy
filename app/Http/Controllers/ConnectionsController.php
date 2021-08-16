<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mode\ModeSession;

class ConnectionsController extends Controller
{
    public function index()
    {

        $navbar_page = 'home';
        $page_title = 'Swap My Energy - Connections';
        return view('index.connections', compact('navbar_page', 'page_title'));
        //return view('index.residential-coming-soon', compact('navbar_page', 'page_title'));
    }
}

