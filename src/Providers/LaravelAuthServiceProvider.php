<?php

namespace LaravelAuth\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');

        $this->publishes([
            __DIR__ . '/../config/laravel-auth.php' => config_path('laravel-auth.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-auth.php', 'laravel-auth'
        );

        config([
            'services' => array_merge(
                config('laravel-auth.socialite.providers')
            )
        ]);
    }
}
