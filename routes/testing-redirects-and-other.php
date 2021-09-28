<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Test Pages
|--------------------------------------------------------------------------
*/

// Route::get('/test/observer', function ()
// {
//     return view('test.observer-api');
// }) -> name('test.observer-api');

// Route::get('/test/page-load', function ()
// {
//     return view('test.page-load');
// }) -> name('test.page-load');

Route::get('/test/testing-znergi-facebook-chat-thingy-majiggiery', function ()
{
    return view('test.facebook-chat-test');
}) -> name('test.facebook-chat');

Route::get('/testing/affiliateLinks/sessions-and-cookies/', function(Request $request)
{
    $session = session() -> get('swapMyEnergyAffiliateToken');
    $cookie = $request -> cookie('swapMyEnergyAffiliateToken');
    return response() -> json(compact('session', 'cookie'));
});


/*
|--------------------------------------------------------------------------
| Error Pages
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/testing/errors/http/error-pages/' ], function()
{
    Route::view('401', 'errors/401', [ 'page_title' => 'Testing - Unauthorized']);
    Route::view('403', 'errors/403', [ 'page_title' => 'Testing - Forbidden']);
    Route::view('404', 'errors/404', [ 'page_title' => 'Testing - Not Found']);
    Route::view('419', 'errors/419', [ 'page_title' => 'Testing - Page Expired']);
    Route::view('429', 'errors/429', [ 'page_title' => 'Testing - Too Many Requests']);
    Route::view('500', 'errors/500', [ 'page_title' => 'Testing - Server Error']);
    Route::view('503', 'errors/503', [ 'page_title' => 'Testing - Service Unavailable']);
});



/*
|--------------------------------------------------------------------------
| Permanant Redirects
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '' ], function()
{
    Route::group([ 'prefix' => '/water' ], function()
    {
        Route::redirect('/', '/business/water', 307);
        Route::redirect('/success', '/business/water/success', 302);
        Route::redirect('/error', '/business/water/error', 302);
    });

    Route::group([ 'prefix' => '/connections' ], function()
    {
        Route::redirect('/', '/business/connections', 307);
        Route::redirect('/success', '/business/connections/success', 302);
        Route::redirect('/error', '/business/connections/error', 302);
    });

    Route::group([ 'prefix' => '/payment-solutions'], function()
    {
        Route::redirect('/', '/business/payment-solutions', 307);
        Route::redirect('/success', '/business/payment-solutions/success', 302);
        Route::redirect('/error', '/business/payment-solutions/error', 302);
    });
});

Route::group([ 'prefix' => '/residential' ], function()
{
    Route::get('/', function() { return redirect('/', 302); });
    Route::get('/about', function() { return redirect('/about', 302); });
    Route::get('/terms-and-conditions', function() { return redirect('/terms-and-conditions', 302); });
    Route::get('/privacy-policy', function() { return redirect('/privacy-policy', 302); });
    Route::get('/contact', function() { return redirect('/contact', 302); });
    Route::get('/partners-and-affiliates', function() { return redirect('/partners-and-affiliates', 302); });
    Route::get('/cookie-policy', function() { return redirect('/cookie-policy', 302); });
    Route::get('/sitemap', function() { return redirect('/sitemap', 302); });
    Route::get('/our-team', function() { return redirect('/our-team', 302); });
});
Route::get('/residential/energy-comparison/address', function() { return redirect('/energy-comparison/address', 302); });
Route::get('/business/energy-comparison/address', function() { return redirect('/energy-comparison/address', 302); });
