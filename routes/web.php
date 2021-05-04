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

Route::get('/', [ HomeController::class, 'index' ]) -> name('Home');
Route::get('about', [ HomeController::class, 'about' ]) -> name('About');
Route::get('privacy-policy', [ HomeController::class, 'privacyPolicy' ]) -> name('Privacy Policy');
Route::get('terms-and-conditions', [ HomeController::class, 'termsAndConditions' ]) -> name('T&C');
Route::get('contact-us', [ HomeController::class, 'contactUs' ]) -> name('Contact Us');
Route::get('support', [ HomeController::class, 'support' ]) -> name('Support');
Route::get('Partners-And-Affiliates', [ HomeController::class, 'partnersAndAffiliates' ]) -> name('Partners and Affiliates');

Route::group(['prefix' => 'account'], function()
{
    Route::get('login', [ AccountController::class, 'login' ]) -> name('Login');
    Route::post('login', [ AccountController::class, 'loginPost' ]) -> name('Login');
    Route::get('sign-up', [ AccountController::class, 'signUp' ]) -> name('Sign Up');
    Route::post('sign-up', [ AccountController::class, 'signUpPost' ]) -> name('Sign Up');
    Route::get('logout', [ AccountController::class, 'logout' ]) -> name('Logout');
    
    Route::get('my-account', [ AccountController::class, 'myAccount' ]) -> name('My Account');
});
