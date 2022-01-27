# Laravel Package Auth

Authorization package for Laravel.

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

### Enable package

To enable auth for a model, add the `LaravelAuth\Helpers\HasAuthentication` trait to the model

```php
namespace App\Models;

use LaravelAuth\Helpers\HasAuthentication;

class User extends Authenticatable
{
    // ...
    
    use HasAuthentication; 
}
```

### Publish Package Configs

In your terminal type:

    php artisan vendor:publish --provider="LaravelAuth\Providers\LaravelAuthServiceProvider"

This command that will be published file with config `config/laravel-auth`.

See the [full configuration file](https://github.com/nazaryuzhyn/laravel-auth/blob/dev/src/config/laravel-auth.php)
for more information.

## Routes

You can use these routes in your app.

| Route                  | Method | Action          |
|------------------------|--------|-----------------|
| `/api/signup`          | POST   | Sign up         |
| `/api/login`           | POST   | Login           |
| `/api/forgot-password` | POST   | Forgot Password |
| `/api/reset-password`  | POST   | Reset Password  |
| `/api/logout`          | DELETE | Logout          |

Also, you can change the routes in the configuration file.
