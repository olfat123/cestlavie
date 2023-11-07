<?php

use App\Http\Controllers\WVerseController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin/wverses',
    'as' => 'wVerse.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
    
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'WVerseController@index',
    ]);

    Route::get('create', [
        'as' => 'create',
        'uses' => 'WVerseController@create',
    ]);

    Route::post('/', [
        'as' => 'store',
        'uses' => 'WVerseController@store',
    ]);

    Route::get('edit/{wVerse}', [
        'as' => 'edit',
        'uses' => 'WVerseController@edit',
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'WVerseController@update',
    ]);

    Route::delete('destroy/{wVerse}', [
        'as' => 'destroy',
        'uses' => 'WVerseController@destroy',
    ]);
    Route::delete('bulkDelete', [
        'as' => 'deleteAll',
        'uses' => 'WVerseController@deleteAll',
    ]);

});