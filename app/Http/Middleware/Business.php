<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Requests\Mode\ModeSession;

class Business
{
    /**
     * Handle an incoming request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if (ModeSession::isBusiness($request))
        {
            return $next($request);
        }
        else
        {
            return redirect() -> route('residential.home');
        }
    }
}
