<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Utility Routes
|--------------------------------------------------------------------------
*/

Route::group([ 'prefix' => '/connections'], function()
{
    Route::get('/', 'ConnectionsController@index') -> name('connections');
    Route::post('/', 'ConnectionsController@connectionsPost') -> name('connections');
    Route::get('/success', 'ConnectionsController@connectionsSuccess') -> name('connections.success');
    Route::get('/error', 'ConnectionsController@connectionsError') -> name('connections.error');
});
