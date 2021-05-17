<?php

namespace App\Http\Requests\Mode;

use Illuminate\Http\Request;

class ModeSession
{
    public static function setBusiness(Request $request)
    {
        $request -> session() -> put('mode', 'business');
    }
    
    public static function setResidential(Request $request)
    {
        $request -> session() -> put('mode', 'residential');
    }

    public static function isBusiness(Request $request)
    {
        return $request -> session() -> get('mode') == 'business';
    }
}