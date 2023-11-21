<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/settings',
    'as' => 'setting.manager.',
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'manager_access',
], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'SettingController@index',
    ]);
    Route::get('create', [
        'as' => 'create',
        'uses' => 'SettingController@create',
    ]);

    Route::post('/', [
        'as' => 'store',
        'uses' => 'SettingController@store',
    ]);

    Route::get('edit/{setting}', [
        'as' => 'edit',
        'uses' => 'SettingController@edit',
    ]);

    Route::patch('update/{id}', [
        'as' => 'update',
        'uses' => 'SettingController@update',
    ]);

    Route::delete('destroy/{setting}', [
        'as' => 'destroy',
        'uses' => 'SettingController@destroy',
    ]);
    Route::delete('bulkDelete', [
        'as' => 'deleteAll',
        'uses' => 'SettingController@deleteAll',
    ]);

});

Route::group([
    'prefix' => 'settings',
    'as' => 'setting.manager.',
    'namespace' => 'App\Http\Controllers',

], function (){
    Route::get('index' , [
        'as'=> 'apiIndex',
        'uses' => 'SettingController@apiIndex',
    ]);
});