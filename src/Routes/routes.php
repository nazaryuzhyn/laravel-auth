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

Route::prefix(config('laravel-auth.prefix_route', 'api'))
    ->name(config('laravel-auth.prefix_route', 'api') . '.')->group(function () {

    Route::post(config('laravel-auth.signup.route', 'signup'), SignUpController::class)
        ->name(config('laravel-auth.signup.route', 'signup'));

    Route::post(config('laravel-auth.login.route', 'login'), LoginController::class)
        ->name(config('laravel-auth.login.route', 'login'));

    Route::post(config('laravel-auth.forgot_password.route', 'forgot-password'), ForgotPasswordController::class)
        ->name(config('laravel-auth.forgot_password.route', 'forgot-password'));

    Route::post(config('laravel-auth.reset_password.route', 'reset-password'), ResetPasswordController::class)
        ->name(config('laravel-auth.reset_password.route', 'reset-password'));

});
