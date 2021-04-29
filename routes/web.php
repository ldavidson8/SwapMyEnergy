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
});

Route::group([ 'prefix' => 'account' ], function()
{
    Route::get('login', function()
    {
        return view('account.login');
    }) -> name('login');

    Route::post('login', function()
    {
        
    });


    Route::get('sign-up', function()
    {
        return view('account.sign-up');
    }) -> name('sign-up');

    Route::post('sign-up', function()
    {
        return view('account.sign-up');
    });
});
