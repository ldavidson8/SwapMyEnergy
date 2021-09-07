<?php

use App\Http\Controllers\Utility\BusinessWaterController;
use App\Http\Controllers\Utility\ConnectionsController;
use App\Http\Controllers\Utility\PaymentsController;

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

Route::group([ 'prefix' => '' ], function()
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

    Route::group([ 'prefix' => '/water' ], function()
    {
        Route::get('/', [ BusinessWaterController::class, 'get' ]) -> name('business.water');
        Route::post('/', [ BusinessWaterController::class, 'post' ]) -> name('business.water');
        Route::get('/success', [ BusinessWaterController::class, 'success' ]) -> name('business.water.success');
        Route::get('/error', [ BusinessWaterController::class, 'error' ]) -> name('business.water.error');
    });

    Route::group([ 'prefix' => '/connections' ], function()
    {
        Route::get('/', [ ConnectionsController::class, 'index' ]) -> name('connections');
        Route::post('/', [ ConnectionsController::class, 'connectionsPost' ]) -> name('connections');
        Route::get('/success', [ ConnectionsController::class, 'connectionsSuccess' ]) -> name('connections.success');
        Route::get('/error', [ ConnectionsController::class, 'connectionsError' ]) -> name('connections.error');
    });

    Route::group([ 'prefix' => '/payment-solutions'], function()
    {
        Route::get('/', [ PaymentsController::class, 'index' ]) -> name('payment-solutions');
        Route::post('/', [ PaymentsController::class, 'Post' ]) -> name('payment-solutions');
        Route::get('/success', [ PaymentsController::class, 'Success' ]) -> name('payment-solutions.success');
        Route::get('/error', [ PaymentsController::class, 'Error' ]) -> name('payment-solution.error');
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

Route::group([ 'prefix' => '/residential' ], function()
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
        // white label redirect
        Route::get('/address', function() { return redirect('https://www.theenergyshop.com/wayInForm?agentID=333-7TDfpTnZOo'); }) -> name('residential.energy-comparison.1-address');

        // pages
        // Route::get('/address', 'ResidentialComparisonController@findAddress') -> name('residential.energy-comparison.1-address');
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
