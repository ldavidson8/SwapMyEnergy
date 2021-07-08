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
        return Session::get('mode') != 'residential';
    }

    public static function getMode()
    {
        return Session::get('mode', 'business');
    }

    public static function getHomeUrl()
    {
        if (self::isBusiness())
        {
            return route('business.home');
        }
        else
        {
            return route('residential.home');
        }
    }
}