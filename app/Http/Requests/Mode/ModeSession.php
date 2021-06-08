<?php

namespace App\Http\Requests\Mode;

use Illuminate\Support\Facades\Session;

class ModeSession
{
    public static function setBusiness()
    {
        Session::put('mode', 'business');
    }
    
    public static function setResidential()
    {
        Session::put('mode', 'residential');
    }

    public static function isBusiness()
    {
        return Session::get('mode') == 'business';
    }
}