<?php

use Illuminate\Support\Facades\Route;
use LaravelAuth\Http\Controllers\ForgotPasswordController;
use LaravelAuth\Http\Controllers\LoginController;
use LaravelAuth\Http\Controllers\LogoutController;
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

        Route::post(
            config('laravel-auth.signup.route', 'signup'),
            config('laravel-auth.signup.controller', SignUpController::class)
        )->name(config('laravel-auth.signup.route', 'signup'));

        Route::post(
            config('laravel-auth.login.route', 'login'),
            config('laravel-auth.login.controller', LoginController::class)
        )->name(config('laravel-auth.login.route', 'login'));

        Route::post(
            config('laravel-auth.forgot_password.route', 'forgot-password'),
            config('laravel-auth.forgot_password.controller', ForgotPasswordController::class)
        )->name(config('laravel-auth.forgot_password.route', 'forgot-password'));

        Route::post(
            config('laravel-auth.reset_password.route', 'reset-password'),
            config('laravel-auth.reset_password.controller', ResetPasswordController::class)
        )->name(config('laravel-auth.reset_password.route', 'reset-password'));

        Route::delete(
            config('laravel-auth.logout.route', 'logout'),
            config('laravel-auth.logout.controller', LogoutController::class)
        )->middleware('auth:sanctum')
            ->name(config('laravel-auth.logout.route', 'logout'));

});
