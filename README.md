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

    php artisan vendor:publish --provider="LaravelAuth\Providers\LaravelAuthServiceProvider" --tag=config

This command that will be published file with config `config/laravel-auth`.

See the [full configuration file](https://github.com/nazaryuzhyn/laravel-auth/blob/dev/src/config/laravel-auth.php)
for more information.

### Publish Controllers

Copy controllers to your project:

    php artisan vendor:publish --provider="LaravelAuth\Providers\LaravelAuthServiceProvider" --tag=controllers

### Publish Requests

Copy requests to your project:

    php artisan vendor:publish --provider="LaravelAuth\Providers\LaravelAuthServiceProvider" --tag=requests

## Routes

You can use these routes in your app.

| Route                  | Method | Action          |
|------------------------|--------|-----------------|
| `/api/signup`          | POST   | Sign up         |
| `/api/login`           | POST   | Login           |
| `/api/logout`          | DELETE | Logout          |
| `/api/forgot-password` | POST   | Forgot Password |
| `/api/reset-password`  | POST   | Reset Password  |

Also, you can change the routes in the configuration file.

### Sign up

You can send the request to route `/api/signup` for the signup.

Body Parameters:

`name` - required, string, min 2, max 160.

`email` - required, string, email, unique, max 80.

`password` - required, string, min 8, max 50.

### Login

You can send the request to route `/api/login` for login.

Body Parameters:

`email` - required without driver and access_token, string.

`password` - required without driver and access_token, string.

`driver` - required without email and password, the value must be one of google or facebook.

`access_token` - required without email and password, string.

For login, via social media, you need a request with parameters `driver` and `access_token`.

### Logout

Requires authentication

You can send the request to route `/api/logout` for the logout.

### Forgot password

You can send the request to route `/api/forgot-password` for send request forgot password.

Body Parameters:

`email` - required, string, email, exists user.

### Reset password

You can send the request to route `/api/reset-password` for the reset password.

Body Parameters:

`token` - required, string, exists token in table 'password_resets'.

`password` - required, string, min 8, max 50.
