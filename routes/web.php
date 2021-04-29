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

Route::group([ 'prefix' => 'account' ], function()
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
