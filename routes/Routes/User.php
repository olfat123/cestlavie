<?php
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => 'manager_access',

], function () {
    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'HomeController@dashboard',
    ]);
    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'HomeController@profile',
    ]);
});

