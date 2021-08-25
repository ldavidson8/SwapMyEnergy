<?php

namespace App\Http\Controllers;

class PaymentsController extends Controller
{
    public function index()
    {
        $navbar_page = 'payments';
        $page_title = 'Swap My Energy - Payment Solutions';
        return view('index.payment-solutions', compact('navbar_page', 'page_title'));
    }
}