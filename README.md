# Laravel Package Auth

## Installation

You can install the package via composer:

    ...

### Register the Package

Register package service provider in `providers` array inside `config/app.php`
```php
    'providers' => [
        // ...
    
        'LaravelAuth\Providers\LaravelAuthServiceProvider',

    ],
```

### Publish Package Configs

In your terminal type:

    php artisan vendor:publish --provider="LaravelAuth\Providers\LaravelAuthServiceProvider"

This is the contents of the `config/laravel-auth` file that will be published:

    ...
