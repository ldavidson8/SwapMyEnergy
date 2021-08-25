<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Utility Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/water' ], function()
{
    Route::get('/', 'BusinessWaterController@get') -> name('business.water');
    Route::post('/', 'BusinessWaterController@post') -> name('business.water');
    Route::get('/success', 'BusinessWaterController@success') -> name('business.water.success');
    Route::get('/error', 'BusinessWaterController@error') -> name('business.water.error');
});

Route::group([ 'prefix' => '/connections' ], function()
{
    Route::get('/', 'ConnectionsController@index') -> name('connections');
    Route::post('/', 'ConnectionsController@connectionsPost') -> name('connections');
    Route::get('/success', 'ConnectionsController@connectionsSuccess') -> name('connections.success');
    Route::get('/error', 'ConnectionsController@connectionsError') -> name('connections.error');
});

Route::group([ 'prefix' => '/payments'], function()
{
    Route::get('/', 'PaymentsController@index') -> name('payments');
    // Route::post('/', 'ContactController@connectionsPost') -> name('connections');
    // Route::get('/success', 'ContactController@connectionsSuccess') -> name('connections.success');
    // Route::get('/error', 'ContactController@connectionsError') -> name('connections.error');
});
