<?php

use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin/configurations',
    'as' => 'config.manager.',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('', [
        'as' => 'index',
        'uses' => 'ConfigController@index',
        //'middleware' => 'permission:view_configurations'
    ]);
    Route::get('clearCache', [
        'as' => 'clearCache',
        'uses' => 'ConfigController@clearCache',
        //'middleware' => 'permission:view_configurations'
    ]);
    Route::patch('update', [
        'as' => 'update',
        'uses' => 'ConfigController@update',
        //'middleware' => 'permission:edit_configurations'
    ]);
});

Route::group([
    'prefix' => 'configurations',
    'as' => 'config.manager.',
    'namespace' => 'App\Http\Controllers',
], function (){
    Route::get('index' , [
        'as'=> 'apiIndex',
        'uses' => 'ConfigController@apiIndex',
    ]);

    Route::post('testpn' , [
        'as'=> 'testpn',
        'uses' => 'HomeController@testpn',
    ]);

});