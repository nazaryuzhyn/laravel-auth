<?php

use Illuminate\Support\Facades\Route;
use LaravelAuth\Http\Controllers\ForgotPasswordController;
use LaravelAuth\Http\Controllers\LoginController;
use LaravelAuth\Http\Controllers\ResetPasswordController;
use LaravelAuth\Http\Controllers\SignUpController;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the middleware group. Enjoy building your route!
|
*/

Route::prefix('api')->name('api.')->group(function () {
    Route::post('signup', SignUpController::class)->name('signup');
    Route::post('login', LoginController::class)->name('login');
    Route::post(config('laravel-auth.forgot_password.route'), ForgotPasswordController::class)
        ->name('forgot-password');
    Route::post('reset-password', ResetPasswordController::class)->name('reset-password');
});
