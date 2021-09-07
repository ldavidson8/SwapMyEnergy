<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Throwable;

class AffiliateLinks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request -> has('affiliateToken'))
        {
            $affiliateToken = $request -> input('affiliateToken');
            try
            {
                $rows = DB::select('call SelectByID_AffiliateCompany(?)', [ $affiliateToken ]);
                if (isset($rows) && count($rows) > 0)
                {
                    $companyName = $rows[0] -> CompanyName;
                    Session::put('swapMyEnergyAffiliateToken', $companyName);
                    $cookie = Cookie::make('swapMyEnergyAffiliateToken', $companyName, 10080);
                    return redirect(url() -> current()) -> withCookie($cookie);
                }
                return redirect(url() -> current());
            }
            catch (Throwable $th)
            {
                report($th);
            }
        }

        return $next($request);
    }
}
