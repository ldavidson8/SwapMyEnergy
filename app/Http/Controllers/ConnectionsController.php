<?php

namespace App\Http\Controllers;

class ConnectionsController extends Controller
{
    public function index()
    {
        $navbar_page = 'connections';
        $page_title = 'Swap My Energy - Connections';
        return view('other.connections', compact('navbar_page', 'page_title'));
    }
}
