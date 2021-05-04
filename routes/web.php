<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
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
Route::get('Partners-And-Affiliates', [ HomeController::class, 'partnersAndAffiliates' ]) -> name('partners and affiliates');

Route::group(['prefix' => 'account'], function()
{
    Route::get('login', [ AccountController::class, 'login' ]) -> name('login');
    Route::post('login', [ AccountController::class, 'loginPost' ]) -> name('login');
    Route::post('register', [ AccountController::class, 'registerPost' ]) -> name('register');
    Route::get('logout', [ AccountController::class, 'logout' ]) -> name('logout');

    Route::get('my-account', [ AccountController::class, 'myAccount' ]) -> name('my account') -> middleware('auth');
});
