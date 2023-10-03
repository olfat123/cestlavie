<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/countries',
    'as' => 'country.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'CountryController@index',
    ]);
    Route::get('create', [
        'as' => 'create',
        'uses' => 'CountryController@create',
    ]);

    Route::post('/', [
        'as' => 'store',
        'uses' => 'CountryController@store',
    ]);

    Route::get('edit/{id}', [
        'as' => 'edit',
        'uses' => 'CountryController@edit',
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'CountryController@update',
    ]);

    Route::delete('destroy/{id}', [
        'as' => 'destroy',
        'uses' => 'CountryController@destroy',
    ]);
    Route::delete('bulkDelete', [
        'as' => 'deleteAll',
        'uses' => 'CountryController@deleteAll',
    ]);

});