<?php

namespace App\Http\Controllers;

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

Route::get('/', function(Request $request)
{
    if ($request -> session() -> get('mode') == 'business')
    {
        return redirect() -> route('business.home');
    }
    else
    {
        return redirect() -> route('residential.home');
    }
}) -> name('home');

Route::group([ 'prefix' => 'business' ], function()
{
    Route::get('/', [ BusinessHomeController::class, 'index' ]) -> name('business.home');
    Route::get('about', [ BusinessHomeController::class, 'about' ]) -> name('business.about');
    Route::get('privacy-policy', [ BusinessHomeController::class, 'privacyPolicy' ]) -> name('business.privacy policy');
    Route::get('terms-and-conditions', [ BusinessHomeController::class, 'termsAndConditions' ]) -> name('business.t&c');
    Route::get('support', [ BusinessHomeController::class, 'support' ]) -> name('business.support');
    Route::get('partners-and-affiliates', [ BusinessHomeController::class, 'partnersAndAffiliates' ]) -> name('business.partners and affiliates');

    Route::group([ 'prefix' => 'my-account', 'middleware' => 'business' ], function()
    {
        Route::get('/', [ BusinessAccountController::class, 'myAccount' ]) -> name('business.my account') -> middleware('password.confirm');
    });
});


Route::group([ 'prefix' => 'residential' ], function()
{
    Route::get('/', [ ResidentialHomeController::class, 'index' ]) -> name('residential.home');
    Route::get('about', [ ResidentialHomeController::class, 'about' ]) -> name('residential.about');
    Route::get('privacy-policy', [ ResidentialHomeController::class, 'privacyPolicy' ]) -> name('residential.privacy policy');
    Route::get('terms-and-conditions', [ ResidentialHomeController::class, 'termsAndConditions' ]) -> name('residential.t&c');
    Route::get('support', [ ResidentialHomeController::class, 'support' ]) -> name('residential.support');
    Route::post('support', [ ResidentialHomeController::class, 'supportPost' ]) -> name('residential.support');
    Route::get('partners-and-affiliates', [ ResidentialHomeController::class, 'partnersAndAffiliates' ]) -> name('residential.partners and affiliates');
    
    Route::group([ 'prefix' => 'my-account', 'middleware' => 'residential' ], function()
    {
        Route::get('/', [ ResidentialAccountController::class, 'myAccount' ]) -> name('residential.my account') -> middleware('password.confirm');
        Route::get('plan', [ ResidentialAccountController::class, 'yourPlan' ]) -> name('residential.my account.plan') -> middleware('password.confirm');
        Route::post('plan', [ ResidentialAccountController::class, 'yourPlanPost' ]) -> name('residential.my account.plan') -> middleware('password.confirm');
        Route::get('details', [ ResidentialAccountController::class, 'yourDetails' ]) -> name('residential.my account.details') -> middleware('password.confirm');
        Route::post('details', [ ResidentialAccountController::class, 'yourDetailsPost' ]) -> name('residential.my account.details') -> middleware('password.confirm');
        Route::get('options', [ ResidentialAccountController::class, 'yourOptions' ]) -> name('residential.my account.options') -> middleware('password.confirm');
        Route::post('options', [ ResidentialAccountController::class, 'yourOptionsPost' ]) -> name('residential.my account.options') -> middleware('password.confirm');
    });
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Hash;

Route::post('/register', [RegisteredUserController::class, 'store']) -> middleware('guest');
Route::get('/login', [AuthenticatedSessionController::class, 'create']) -> middleware('guest') -> name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']) -> middleware('guest');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']) -> middleware('auth') -> name('logout');

// forgot password get
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create']) -> middleware('guest') -> name('password.request');
// forgot password post
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']) -> middleware('guest') -> name('password.email');
// forgot password email sent get
Route::get('/forgot-password-email-sent', [PasswordResetLinkController::class, 'sent' ]) -> middleware('guest') -> name('password.emailsent');

// TODO: integrate
Route::get('/reset-password/{token}/{email}', [NewPasswordController::class, 'create']) -> middleware('guest') -> name('password.reset');
// TODO: integrate
Route::post('/reset-password', [NewPasswordController::class, 'store']) -> middleware('guest') -> name('password.update');

// TODO: integrate
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke']) -> middleware('auth') -> name('verification.notice');
// TODO: integrate
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke']) -> middleware(['auth', 'signed', 'throttle:6,1']) -> name('verification.verify');
// TODO: integrate
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store']) -> middleware(['auth', 'throttle:6,1']) -> name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show']) -> middleware('auth') -> name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']) -> middleware('auth') -> name('password.confirm');
