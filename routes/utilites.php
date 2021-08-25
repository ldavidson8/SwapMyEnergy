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
    Route::post('/', 'ContactController@connectionsPost') -> name('connections');
    Route::get('/success', 'ContactController@connectionsSuccess') -> name('connections.success');
    Route::get('/error', 'ContactController@connectionsError') -> name('connections.error');
});
