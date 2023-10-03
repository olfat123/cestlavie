<?php

use App\Http\Controllers\WMessageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/wmessages',
    'as' => 'wMessage.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'WMessageController@index',
    ]);
    Route::get('create', [
        'as' => 'create',
        'uses' => 'WMessageController@create',
    ]);

    Route::post('/', [
        'as' => 'store',
        'uses' => 'WMessageController@store',
    ]);

    Route::get('edit/{wMessage}', [
        'as' => 'edit',
        'uses' => 'WMessageController@edit',
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'WMessageController@update',
    ]);

    Route::delete('destroy/{wMessage}', [
        'as' => 'destroy',
        'uses' => 'WMessageController@destroy',
    ]);

    Route::delete('bulkDelete', [
        'as' => 'deleteAll',
        'uses' => 'WMessageController@deleteAll',
    ]);

});