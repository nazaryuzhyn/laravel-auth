<?php

namespace LaravelAuth\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelAuthServiceProvider.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Providers
 */
class LaravelAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'auth.guards.sanctum' => array_merge([
                'driver' => 'sanctum',
                'provider' => null,
            ], config('auth.guards.sanctum', [
                'driver' => 'session',
                'provider' => 'users',
            ])),
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');

        $this->publishesConfig();

        $this->publishesControllers();

        $this->publishesRequests();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-auth.php', 'laravel-auth'
        );

        config([
            'services' => array_merge(
                config('laravel-auth.socialite.providers')
            )
        ]);
    }

    /**
     * Publish config.
     *
     * @return void
     */
    protected function publishesConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-auth.php' => config_path('laravel-auth.php'),
        ], 'config');
    }

    /**
     * Publish controllers.
     *
     * @return void
     */
    protected function publishesControllers()
    {
        $this->publishes([
            __DIR__ . '/../Http/Controllers/LoginController.php' => app_path(
                'Http/Controllers/LoginController.php'
            ),
            __DIR__ . '/../Http/Controllers/SignUpController.php' => app_path(
                'Http/Controllers/SignUpController.php'
            ),
            __DIR__ . '/../Http/Controllers/LogoutController.php' => app_path(
                'Http/Controllers/LogoutController.php'
            ),
            __DIR__ . '/../Http/Controllers/ForgotPasswordController.php' => app_path(
                'Http/Controllers/ForgotPasswordController.php'
            ),
            __DIR__ . '/../Http/Controllers/ResetPasswordController.php' => app_path(
                'Http/Controllers/ResetPasswordController.php'
            ),
            __DIR__ . '/../Http/Controllers/DeviceController.php' => app_path(
                'Http/Controllers/DeviceController.php'
            ),
            __DIR__ . '/../Http/Controllers/DeleteTokenController.php' => app_path(
                'Http/Controllers/DeleteTokenController.php'
            ),
        ], 'controllers');
    }

    /**
     * Publish requests.
     *
     * @return void
     */
    protected function publishesRequests()
    {
        $this->publishes([
            __DIR__ . '/../Http/Requests/LoginRequest.php' => app_path(
                'Http/Requests/LoginRequest.php'
            ),
            __DIR__ . '/../Http/Requests/SignUpRequest.php' => app_path(
                'Http/Requests/SignUpRequest.php'
            ),
            __DIR__ . '/../Http/Requests/ForgotPasswordRequest.php' => app_path(
                'Http/Requests/ForgotPasswordRequest.php'
            ),
            __DIR__ . '/../Http/Requests/ResetPasswordRequest.php' => app_path(
                'Http/Requests/ResetPasswordRequest.php'
            ),
        ], 'requests');
    }
}
