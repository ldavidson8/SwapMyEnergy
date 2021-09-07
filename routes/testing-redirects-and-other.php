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
    Route::get('401', function() { abort(401); });
    Route::get('403', function() { abort(403); });
    Route::get('404', function() { abort(404); });
    Route::get('419', function() { abort(419); });
    Route::get('429', function() { abort(429); });
    Route::get('500', function() { abort(500); });
    Route::get('503', function() { abort(503); });
});



/*
|--------------------------------------------------------------------------
| Temporary Redirects
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/business' ], function()
{
    Route::get('/', function() { return redirect('/', 307); });
    Route::get('/about', function() { return redirect('/about', 307); });
    Route::get('/terms-and-conditions', function() { return redirect('/terms-and-conditions', 307); });
    Route::get('/privacy-policy', function() { return redirect('/privacy-policy', 307); });
    Route::get('/contact', function() { return redirect('/contact', 307); });
    Route::get('/partners-and-affiliates', function() { return redirect('/partners-and-affiliates', 307); });
    Route::get('/cookie-policy', function() { return redirect('/cookie-policy', 307); });
    Route::get('/sitemap', function() { return redirect('/sitemap', 307); });
    Route::get('/our-team', function() { return redirect('/our-team', 307); });
});
Route::get('/energy-comparison/address', function() { return redirect('/residential/energy-comparison/address', 307); });
Route::get('/business/energy-comparison/address', function() { return redirect('/residential/energy-comparison/address', 307); });



/*
|--------------------------------------------------------------------------
| Permanant Redirects
|--------------------------------------------------------------------------
*/

// Route::group([ 'prefix' => '/residential' ], function()
// {
//     Route::get('/', function() { return redirect('/', 301); });
//     Route::get('/about', function() { return redirect('/about', 301); });
//     Route::get('/terms-and-conditions', function() { return redirect('/terms-and-conditions', 301); });
//     Route::get('/privacy-policy', function() { return redirect('/privacy-policy', 301); });
//     Route::get('/contact', function() { return redirect('/contact', 301); });
//     Route::get('/partners-and-affiliates', function() { return redirect('/partners-and-affiliates', 301); });
//     Route::get('/cookie-policy', function() { return redirect('/cookie-policy', 301); });
//     Route::get('/sitemap', function() { return redirect('/sitemap', 301); });
//     Route::get('/energy-comparison/address', function() { return redirect('/energy-comparison/address', 301); });
// });
// Route::get('/business/energy-comparison/address', function() { return redirect('/energy-comparison/address', 301); });
