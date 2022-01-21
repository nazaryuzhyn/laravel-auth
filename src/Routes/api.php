<?php

use Illuminate\Support\Facades\Route;
use LaravelAuth\Http\Controllers\LoginController;
use LaravelAuth\Http\Controllers\SignUpController;

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

Route::prefix('api')->name('api.')->group(function () {
    Route::post('signup', SignUpController::class)->name('signup');
    Route::post('login', LoginController::class)->name('login');
});
