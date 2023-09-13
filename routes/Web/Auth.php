<?php
Route::group([
    'namespace' => 'App\Http\Controllers\Auth\Web',
], function () {

    // forgot password
    Route::group(['prefix' => 'password'], function () {
        Route::post('email', [
            'uses' => 'ForgotPasswordController@sendResetLinkEmail',
            'as'   => 'password.email',
        ]);

        Route::post('reset', [
            'uses' => 'ResetPasswordController@reset',
            'as'   => 'password.update',
        ]);
    });
    Route::get('admin/password/reset', [
        'uses' => 'ForgotPasswordController@showLinkRequestForm',
        'as'   => 'password.request',
    ]);
   
    Route::get('admin/password/reset/{token}', [
        'uses' => 'ResetPasswordController@showResetForm',
        'as'   => 'admin_password.reset',
    ]);
    Route::get('admin/login', [
        'uses' => 'LoginController@showAdminLoginForm',
        'as'   => 'admin.login',
    ]);
        // login
        Route::group(['prefix' => 'login'], function () {
            Route::get('/', [
                'uses' => 'LoginController@showLoginForm',
                'as'   => 'login',
            ]);
    
            Route::post('/', [
                'uses' => 'LoginController@login',
                'as'   => 'login.store',
            ]);
        });
    // logout
    Route::post('logout', [
        'uses' => 'LoginController@logout',
        'as'   => 'logout',
    ]);
});
