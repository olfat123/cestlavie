<?php

use App\Http\Controllers\ManualMessageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/manual-messages',
    'as' => 'manualMessage.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'ManualMessageController@index',
    ]);
    Route::get('create', [
        'as' => 'create',
        'uses' => 'ManualMessageController@create',
    ]);

    Route::post('/', [
        'as' => 'store',
        'uses' => 'ManualMessageController@store',
    ]);

    Route::get('edit/{manualMessage}', [
        'as' => 'edit',
        'uses' => 'ManualMessageController@edit',
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'ManualMessageController@update',
    ]);

    Route::delete('destroy/{manualMessage}', [
        'as' => 'destroy',
        'uses' => 'ManualMessageController@destroy',
    ]);
    Route::delete('bulkDelete', [
        'as' => 'deleteAll',
        'uses' => 'ManualMessageController@deleteAll',
    ]);

});