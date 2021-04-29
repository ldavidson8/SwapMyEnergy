<?php

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

Route::get('/', function () {
    return view('index');
}) -> name('Home');


Route::group(['prefix' => 'account'], function()
{
    Route::get('login', function()
    {
        return view('account.login');
    }) -> name('Login');

    Route::post('login', function()
    {
        
    });

    Route::get('sign-up', function()
    {
        return view('account.sign-up');
    }) -> name('Sign Up');

    Route::post('sign-up', function()
    {
        return view('account.sign-up');
    });

    Route::get('logout', function()
    {
        return view('account.logout');
    }) -> name('Logout');
    
    Route::get('my-account', function()
    {
        return view('account.my-account');
    }) -> name('My Account');
});


Route::get('about', function()
{
    return view('other.about');
}) -> name('About');

Route::get('privacy-policy', function()
{
    return view('other.privacy');
}) -> name('Privacy Policy');

Route::get('terms-and-conditions', function()
{
    return view('other.t&c');
}) -> name('T&C');

Route::get('contact-us', function()
{
    return view('other.contact-us');
}) -> name('Contact Us');

Route::get('support', function()
{
    return view('other.support');
}) -> name('Support');

Route::get('Partners-And-Affiliates', function()
{
    return view('other.partners-and-affiliates');
}) -> name('Partners and Affiliates');
