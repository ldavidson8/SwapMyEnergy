<?php

use App\Http\Controllers\Api\ResidentialApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Business Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => 'business' ], function()
{
    Route::get('/', 'BusinessHomeController@index') -> name('business.home');
    Route::get('/about', 'BusinessHomeController@about') -> name('business.about');
    Route::get('/privacy-policy', 'BusinessHomeController@privacyPolicy') -> name('business.privacy policy');
    Route::get('/terms-and-conditions', 'BusinessHomeController@termsAndConditions') -> name('business.t&c');
    Route::get('/cookie-policy', 'BusinessHomeController@cookiePolicy') -> name('business.cookie policy');
    Route::get('/sitemap', 'BusinessHomeController@siteMap') -> name('business.sitemap');
    Route::get('/contact', 'BusinessHomeController@contact') -> name('business.contact');
    Route::get('/partners-and-affiliates', 'BusinessHomeController@partnersAndAffiliates') -> name('business.partners and affiliates');
    Route::get('/our-team', 'BusinessHomeController@ourTeam') -> name('business.our-team');

    Route::group([ 'prefix' => '/request-callback' ], function()
    {
        Route::post('/', 'BusinessContactController@requestCallbackPost') -> name('business.request-callback');
        Route::get('/success', 'BusinessContactController@requestCallbackSuccess') -> name('business.request-callback.success');
        Route::get('/error', 'BusinessContactController@requestCallbackError') -> name('business.request-callback.error');
    });

    // my-account section
    // Route::group([ 'prefix' => 'my-account', 'middleware' => 'business' ], function()
    // {
    //     Route::get('/', 'BusinessAccountController@myAccount') -> name('business.my account') -> middleware('password.confirm');
    // });
});


/*
|--------------------------------------------------------------------------
| Residential Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/' ], function()
{
    Route::get('/', 'ResidentialHomeController@index') -> name('residential.home');
    Route::get('/about', 'ResidentialHomeController@about') -> name('residential.about');
    Route::get('/privacy-policy', 'ResidentialHomeController@privacyPolicy') -> name('residential.privacy policy');
    Route::get('/terms-and-conditions', 'ResidentialHomeController@termsAndConditions') -> name('residential.t&c');
    Route::get('/cookie-policy', 'ResidentialHomeController@cookiePolicy') -> name('residential.cookie policy');
    Route::get('/sitemap', 'ResidentialHomeController@siteMap') -> name('residential.sitemap');
    Route::get('/contact', 'ResidentialHomeController@contact') -> name('residential.contact');
    Route::get('/partners-and-affiliates', 'ResidentialHomeController@partnersAndAffiliates') -> name('residential.partners and affiliates');
    Route::get('/our-team', 'ResidentialHomeController@ourTeam') -> name('residential.our-team');

    // Route::group([ 'prefix' => '/my-account', 'middleware' => 'residential' ], function()
    // {
    //     Route::get('/', 'ResidentialAccountController@myAccount') -> name('residential.my account') -> middleware('password.confirm');
    //     Route::get('/plan', 'ResidentialAccountController@yourPlan') -> name('residential.my account.plan') -> middleware('password.confirm');
    //     Route::post('/plan', 'ResidentialAccountController@yourPlanPost') -> name('residential.my account.plan') -> middleware('password.confirm');
    //     Route::get('/details', 'ResidentialAccountController@yourDetails') -> name('residential.my account.details') -> middleware('password.confirm');
    //     Route::post('/details', 'ResidentialAccountController@yourDetailsPost') -> name('residential.my account.details') -> middleware('password.confirm');
    //     Route::get('/options', 'ResidentialAccountController@yourOptions') -> name('residential.my account.options') -> middleware('password.confirm');
    //     Route::post('/options', 'ResidentialAccountController@yourOptionsPost') -> name('residential.my account.options') -> middleware('password.confirm');
    // });

    Route::group([ 'prefix' => '/energy-comparison' ], function()
    {
        // pages
        Route::get('/address', 'ResidentialComparisonController@findAddress') -> name('residential.energy-comparison.1-address');
        // Route::post('/address', 'ResidentialComparisonController@findAddressPost') -> name('residential.energy-comparison.1-address');
        // Route::get('/existing-tariff', 'ResidentialComparisonController@setExistingTariff') -> name('residential.energy-comparison.2-existing-tariff');
        // Route::post('/existing-tariff', 'ResidentialComparisonController@setExistingTariffPost') -> name('residential.energy-comparison.2-existing-tariff');
        // Route::get('/browse-deals', 'ResidentialComparisonController@browseDeals') -> name('residential.energy-comparison.3-browse-deals');
        // Route::post('/browse-deals', 'ResidentialComparisonController@browseDealsPost') -> name('residential.energy-comparison.3-browse-deals');
        // Route::get('/get-switching', 'ResidentialComparisonController@getSwitching') -> name('residential.energy-comparison.4-get-switching');
        // Route::post('/get-switching', 'ResidentialComparisonController@getSwitchingPost') -> name('residential.energy-comparison.4-get-switching');
        // Route::get('/success', 'ResidentialComparisonController@success') -> name('residential.energy-comparison.success');

        // api
        // Route::post('/addresses/{postcode}', 'ResidentialApiController@addresses') -> name('residential.energy-comparison.api.addresses');
        // Route::post('/addresses/{postcode}/{houseNo}', 'ResidentialApiController@addresses_byHouseNo') -> name('residential.energy-comparison.api.addresses-by-postcode');
        // Route::post('/addresses/mprn/{postcode}/{houseNo}', 'ResidentialApiController@addresses_mprn') -> name('residential.energy-comparison.api.addresses.mprn');
        // Route::post('/addresses/mprndetails/{mprn}', 'ResidentialApiController@addresses_mprndetails') -> name('residential.energy-comparison.api.addresses.mprndetails');
        // Route::post('/suppliers', 'ResidentialApiController@suppliers') -> name('residential.energy-comparison.api.suppliers');
        // Route::post('/suppliers/{supplierId}', 'ResidentialApiController@supplierById') -> name('residential.energy-comparison.api.suppliers.by-id');
        // Route::post('/paymentMethods/suppliers/{supplierId}/{serviceType}', 'ResidentialApiController@paymentMethods_suppliers']) -> name('residential.energy-comparison.api.paymentMethods.by-supplier-id');
        // Route::post('/tariffs/suppliers/{supplierId}/{regionId}/{serviceType}/{paymentMethod}/{e7}', 'ResidentialApiController@tariffs_forASuppllier']) -> name('residential.energy-comparison.api.tariffs.for-a-suppllier');
    });
});


/*
|--------------------------------------------------------------------------
| Other Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/connections'], function()
{
    Route::get('/', 'ConnectionsController@index') -> name('connections');
    Route::post('/', 'ContactController@connectionsPost') -> name('connections');
    Route::get('/success', 'ContactController@connectionsSuccess') -> name('connections.success');
    Route::get('/error', 'ContactController@connectionsError') -> name('connections.error');
});

Route::group([ 'prefix' => '/partner-apply'], function()
{
    Route::post('/', 'ContactController@partnerApplyPost') -> name('partner-apply');
    Route::get('/success', 'ContactController@partnerApplySuccess') -> name('partner-apply.success');
    Route::get('/error', 'ContactController@partnerApplyError') -> name('partner-apply.error');
});

Route::group([ 'prefix' => '/raise-support-request' ], function()
{
    Route::post('/', 'ContactController@raiseSupportRequestPost') -> name('raise-support-request');
    Route::get('/success/{ticket}', 'ContactController@raiseSupportRequestSuccess') -> name('raise-support-request.success');
    Route::get('/error', 'ContactController@raiseSupportRequestError') -> name('raise-support-request.error');
});

Route::group([ 'prefix' => '/affiliate-apply'], function()
{
    Route::post('/', 'ContactController@affiliateApplyPost') -> name('affiliate-apply');
    Route::get('/success', 'ContactController@affiliateApplySuccess') -> name('affiliate-apply.success');
    Route::get('/error', 'ContactController@affiliateApplyError') -> name('affiliate-apply.error');
});


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
| Permanant Redirects
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/residential' ], function()
{
    Route::get('/', function() { return redirect('/', 301); });
    Route::get('/about', function() { return redirect('/about', 301); });
    Route::get('/terms-and-conditions', function() { return redirect('/terms-and-conditions', 301); });
    Route::get('/privacy-policy', function() { return redirect('/privacy-policy', 301); });
    Route::get('/contact', function() { return redirect('/contact', 301); });
    Route::get('/partners-and-affiliates', function() { return redirect('/partners-and-affiliates', 301); });
    Route::get('/cookie-policy', function() { return redirect('/cookie-policy', 301); });
    Route::get('/sitemap', function() { return redirect('/sitemap', 301); });
    Route::get('/energy-comparison/address', function() { return redirect('/energy-comparison/address', 301); });
});
Route::get('/business/energy-comparison/address', function() { return redirect('/energy-comparison/address', 301); });
