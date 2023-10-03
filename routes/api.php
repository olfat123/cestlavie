<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$dirs = ['Api', 'Routes'];

Route::group(['as' => 'api.'], function () use ($dirs) { // to differentiate api from web routes

    foreach ($dirs as $dir) {
        foreach (app('files')->allFiles(__DIR__ . "/$dir") as $route_file) {
            require $route_file->getPathname();
        }
    }
});
