<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$dirs = ['Web', 'Api', 'Routes'];

Route::group([
    //'prefix' => LaravelLocalization::setLocale(),
    //'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
], function () use ($dirs) {
    foreach ($dirs as $dir) {
        foreach (app('files')->allFiles(__DIR__ . "/$dir") as $route_file) {
            require $route_file->getPathname();
        }
    }
});