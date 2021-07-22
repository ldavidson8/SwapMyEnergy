<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResidentialApiController;
use App\Http\Requests\Mode\ModeSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    Route::get('/', [ BusinessHomeController::class, 'index' ]) -> name('business.home');
    Route::get('/about', [ BusinessHomeController::class, 'about' ]) -> name('business.about');
    Route::get('/privacy-policy', [ BusinessHomeController::class, 'privacyPolicy' ]) -> name('business.privacy policy');
    Route::get('/terms-and-conditions', [ BusinessHomeController::class, 'termsAndConditions' ]) -> name('business.t&c');
    Route::get('/cookie-policy', [ BusinessHomeController::class, 'cookiePolicy' ]) -> name('business.cookie policy');
    Route::get('/sitemap', [ BusinessHomeController::class, 'siteMap' ]) -> name('business.sitemap');
    Route::get('/contact', [ BusinessHomeController::class, 'contact' ]) -> name('business.contact');
    Route::get('/partners-and-affiliates', [ BusinessHomeController::class, 'partnersAndAffiliates' ]) -> name('business.partners and affiliates');

    Route::group([ 'prefix' => '/request-callback' ], function()
    {
        Route::post('/', [ BusinessContactController::class, 'requestCallbackPost' ]) -> name('business.request-callback');
        Route::get('/success', [ BusinessContactController::class, 'requestCallbackSuccess' ]) -> name('business.request-callback.success');
        Route::get('/error', [ BusinessContactController::class, 'requestCallbackError' ]) -> name('business.request-callback.error');
    });
    
    // my-account section
    // Route::group([ 'prefix' => 'my-account', 'middleware' => 'business' ], function()
    // {
    //     Route::get('/', [ BusinessAccountController::class, 'myAccount' ]) -> name('business.my account') -> middleware('password.confirm');
    // });
});


/*
|--------------------------------------------------------------------------
| Residential Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/residential' ], function()
{
    Route::get('/', [ ResidentialHomeController::class, 'index' ]) -> name('residential.home');
    Route::get('/about', [ ResidentialHomeController::class, 'about' ]) -> name('residential.about');
    Route::get('/privacy-policy', [ ResidentialHomeController::class, 'privacyPolicy' ]) -> name('residential.privacy policy');
    Route::get('/terms-and-conditions', [ ResidentialHomeController::class, 'termsAndConditions' ]) -> name('residential.t&c');
    Route::get('/cookie-policy', [ ResidentialHomeController::class, 'cookiePolicy' ]) -> name('residential.cookie policy');
    Route::get('/sitemap', [ ResidentialHomeController::class, 'siteMap' ]) -> name('residential.sitemap');
    Route::get('/contact', [ ResidentialHomeController::class, 'contact' ]) -> name('residential.contact');
    Route::get('/partners-and-affiliates', [ ResidentialHomeController::class, 'partnersAndAffiliates' ]) -> name('residential.partners and affiliates');
    
    // Route::group([ 'prefix' => '/my-account', 'middleware' => 'residential' ], function()
    // {
    //     Route::get('/', [ ResidentialAccountController::class, 'myAccount' ]) -> name('residential.my account') -> middleware('password.confirm');
    //     Route::get('/plan', [ ResidentialAccountController::class, 'yourPlan' ]) -> name('residential.my account.plan') -> middleware('password.confirm');
    //     Route::post('/plan', [ ResidentialAccountController::class, 'yourPlanPost' ]) -> name('residential.my account.plan') -> middleware('password.confirm');
    //     Route::get('/details', [ ResidentialAccountController::class, 'yourDetails' ]) -> name('residential.my account.details') -> middleware('password.confirm');
    //     Route::post('/details', [ ResidentialAccountController::class, 'yourDetailsPost' ]) -> name('residential.my account.details') -> middleware('password.confirm');
    //     Route::get('/options', [ ResidentialAccountController::class, 'yourOptions' ]) -> name('residential.my account.options') -> middleware('password.confirm');
    //     Route::post('/options', [ ResidentialAccountController::class, 'yourOptionsPost' ]) -> name('residential.my account.options') -> middleware('password.confirm');
    // });

    Route::group([ 'prefix' => '/energy-comparison' ], function()
    {
        // pages
        Route::get('/address', [ ResidentialComparisonController::class, 'findAddress' ]) -> name('residential.energy-comparison.1-address');
        Route::post('/address', [ ResidentialComparisonController::class, 'findAddressPost' ]) -> name('residential.energy-comparison.1-address');
        Route::get('/existing-tariff', [ ResidentialComparisonController::class, 'setExistingTariff' ]) -> name('residential.energy-comparison.2-existing-tariff');
        Route::post('/existing-tariff', [ ResidentialComparisonController::class, 'setExistingTariffPost' ]) -> name('residential.energy-comparison.2-existing-tariff');
        Route::get('/browse-deals', [ ResidentialComparisonController::class, 'browseDeals' ]) -> name('residential.energy-comparison.3-browse-deals');
        Route::post('/browse-deals', [ ResidentialComparisonController::class, 'browseDealsPost' ]) -> name('residential.energy-comparison.3-browse-deals');
        Route::get('/get-switching', [ ResidentialComparisonController::class, 'getSwitching' ]) -> name('residential.energy-comparison.4-get-switching');
        Route::post('/get-switching', [ ResidentialComparisonController::class, 'getSwitchingPost' ]) -> name('residential.energy-comparison.4-get-switching');
        Route::get('/success', [ ResidentialComparisonController::class, 'success' ]) -> name('residential.energy-comparison.success');
        
        // api
        Route::post('/addresses/{postcode}', [ ResidentialApiController::class, 'addresses' ]) -> name('residential.energy-comparison.api.addresses');
        Route::post('/addresses/{postcode}/{houseNo}', [ ResidentialApiController::class, 'addresses_byHouseNo' ]) -> name('residential.energy-comparison.api.addresses-by-postcode');
        Route::post('/addresses/mprn/{postcode}/{houseNo}', [ ResidentialApiController::class, 'addresses_mprn' ]) -> name('residential.energy-comparison.api.addresses.mprn');
        Route::post('/addresses/mprndetails/{mprn}', [ ResidentialApiController::class, 'addresses_mprndetails' ]) -> name('residential.energy-comparison.api.addresses.mprndetails');
        Route::post('/suppliers', [ ResidentialApiController::class, 'suppliers' ]) -> name('residential.energy-comparison.api.suppliers');
        Route::post('/suppliers/{supplierId}', [ ResidentialApiController::class, 'supplierById' ]) -> name('residential.energy-comparison.api.suppliers.by-id');
        Route::post('/paymentMethods/suppliers/{supplierId}/{serviceType}', [ ResidentialApiController::class, 'paymentMethods_suppliers']) -> name('residential.energy-comparison.api.paymentMethods.by-supplier-id');
        Route::post('/tariffs/suppliers/{supplierId}/{regionId}/{serviceType}/{paymentMethod}/{e7}', [ ResidentialApiController::class, 'tariffs_forASuppllier']) -> name('residential.energy-comparison.api.tariffs.for-a-suppllier');
    });
});


/*
|--------------------------------------------------------------------------
| Contact Form Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/partner-apply'], function()
{
    Route::post('/', [ ContactController::class, 'partnerApplyPost' ]) -> name('partner-apply');
    Route::get('/success', [ ContactController::class, 'partnerApplySuccess' ]) -> name('partner-apply.success');
    Route::get('/error', [ ContactController::class, 'partnerApplyError' ]) -> name('partner-apply.error');
});

Route::group([ 'prefix' => '/raise-support-request' ], function()
{
    Route::post('/', [ ContactController::class, 'raiseSupportRequestPost' ]) -> name('raise-support-request');
    Route::get('/success/{ticket}', [ ContactController::class, 'raiseSupportRequestSuccess' ]) -> name('raise-support-request.success');
    Route::get('/error', [ ContactController::class, 'raiseSupportRequestError' ]) -> name('raise-support-request.error');
});

Route::group([ 'prefix' => '/affiliate-apply'], function()
{
    Route::post('/', [ ContactController::class, 'affiliateApplyPost' ]) -> name('affiliate-apply');
    Route::get('/success', [ ContactController::class, 'affiliateApplySuccess' ]) -> name('affiliate-apply.success');
    Route::get('/error', [ ContactController::class, 'affiliateApplyError' ]) -> name('affiliate-apply.error');
});



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\VerifyEmailController;

// Route::post('/register', [RegisteredUserController::class, 'store']) -> middleware('guest');
// Route::get('/login', [AuthenticatedSessionController::class, 'create']) -> middleware('guest') -> name('login');
// Route::post('/login', [AuthenticatedSessionController::class, 'store']) -> middleware('guest');
// Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']) -> middleware('auth') -> name('logout');

// // forgot password get
// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']) -> middleware('guest') -> name('password.request');
// // forgot password post
// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']) -> middleware('guest') -> name('password.email');
// // forgot password email sent get
// Route::get('/forgot-password-email-sent', [PasswordResetLinkController::class, 'sent' ]) -> middleware('guest') -> name('password.emailsent');

// // TODO: integrate
// Route::get('/reset-password/{token}/{email}', [NewPasswordController::class, 'create']) -> middleware('guest') -> name('password.reset');
// // TODO: integrate
// Route::post('/reset-password', [NewPasswordController::class, 'store']) -> middleware('guest') -> name('password.update');

// // TODO: integrate
// Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke']) -> middleware('auth') -> name('verification.notice');
// // TODO: integrate
// Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke']) -> middleware(['auth', 'signed', 'throttle:6,1']) -> name('verification.verify');
// // TODO: integrate
// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store']) -> middleware(['auth', 'throttle:6,1']) -> name('verification.send');

// Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show']) -> middleware('auth') -> name('password.confirm');
// Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']) -> middleware('auth') -> name('password.confirm');


// test pages

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


// test pages

// Route::get('/testing/qwerty-keyboard/sonic-the-hedgehog/sql', function()
// {
//     return response() -> json(DB::select('select * from users'));
// });

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
