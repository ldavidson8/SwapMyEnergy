<?php

namespace App\Http\Controllers;

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

Route::get('/', [ HomeController::class, 'index' ]) -> name('home');
Route::get('about', [ HomeController::class, 'about' ]) -> name('about');
Route::get('privacy-policy', [ HomeController::class, 'privacyPolicy' ]) -> name('privacy policy');
Route::get('terms-and-conditions', [ HomeController::class, 'termsAndConditions' ]) -> name('t&c');
Route::get('contact-us', [ HomeController::class, 'contactUs' ]) -> name('contact us');
Route::get('support', [ HomeController::class, 'support' ]) -> name('support');
Route::get('partners-and-affiliates', [ HomeController::class, 'partnersAndAffiliates' ]) -> name('partners and affiliates');

Route::group(['prefix' => 'my-account'], function()
{
    Route::get('', [ AccountController::class, 'myAccount' ]) -> name('my account') -> middleware('password.confirm');
    Route::get('plan', [ AccountController::class, 'yourPlan' ]) -> name('my account.plan') -> middleware('password.confirm');
    Route::post('plan', [ AccountController::class, 'yourPlanPost' ]) -> name('my account.plan') -> middleware('password.confirm');
    Route::get('details', [ AccountController::class, 'yourDetails' ]) -> name('my account.details') -> middleware('password.confirm');
    Route::post('details', [ AccountController::class, 'yourDetailsPost' ]) -> name('my account.details') -> middleware('password.confirm');
    Route::get('options', [ AccountController::class, 'yourOptions' ]) -> name('my account.options') -> middleware('password.confirm');
    Route::post('options', [ AccountController::class, 'yourOptionsPost' ]) -> name('my account.options') -> middleware('password.confirm');
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

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

// forgot password get
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');
// forgot password post
// TODO: test
// TODO: install xampp mailchimp
// TODO: setup mail system
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

// TODO: integrate
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');
// TODO: integrate
Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

// TODO: integrate
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');
// TODO: integrate
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');
// TODO: integrate
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
