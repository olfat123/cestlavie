<?php

use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/tokens',
    'as' => 'token.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'TokenController@index',
    ]);
});

Route::group([
    'prefix' => 'tokens',
    'as' => 'token.',
    'namespace' => 'App\Http\Controllers',
], function () {

    Route::post('/', [
        'as' => 'store',
        'uses' => 'TokenController@store',
    ]);

});