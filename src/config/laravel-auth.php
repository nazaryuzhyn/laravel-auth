<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | If you are using a custom model you can specify it here.
    | Leave as null to use default user model.
    |
    */
    'user_model' => null,


    /*
    |--------------------------------------------------------------------------
    | User Resource
    |--------------------------------------------------------------------------
    */
    'user_resource' => LaravelAuth\Http\Resources\UserResource::class,


    /*
    |--------------------------------------------------------------------------
    | Prefix to routes
    |--------------------------------------------------------------------------
    */
    'prefix_route' => 'api',


    /*
    |--------------------------------------------------------------------------
    | Socialite providers
    |--------------------------------------------------------------------------
    |
    | Before using Socialite, you will need to add credentials
    | for the OAuth providers your application utilizes.
    | Example using google driver and credentials for your provider.
    |
    */
    'socialite' => [

        'providers' => [

            'google' => [
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'redirect' => env('GOOGLE_REDIRECT'),
            ],

            'facebook' => [
                'client_id' => env('FACEBOOK_CLIENT_ID'),
                'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
                'redirect' => env('FACEBOOK_REDIRECT'),
            ],

            // ...

        ]

    ],


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    |
    | After using this package you can change the route `login`,
    | in section `route`.
    |
    */
    'login' => [

        /*
         * Route to Log in
         */
        'route' => 'login',

    ],


    /*
    |--------------------------------------------------------------------------
    | Signup
    |--------------------------------------------------------------------------
    |
    | If you need added new field to save, just add validation rules down.
    | Also, you can change the route `signup`, in section `route`.
    |
    */
    'signup' => [

        /*
         * Route to Sign Up
         */
        'route' => 'signup',

    ],


    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    |
    | You can change route `forgot-password` in section `route`.
    |
    */
    'forgot_password' => [

        /*
         * Route to Forgot Password
         */
        'route' => 'forgot-password',
    ],


    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    |
    | You can change route `reset-password` in section `route`.
    | It is also possible to change the web_url that comes
    | in the password reset email.
    | In section `notification` you can change class on your.
    |
    */
    'reset_password' => [

        /*
         * Route to Reset Password
         */
        'route' => 'reset-password',

        /*
         * Web url to reset password
         */
        'web_url' => env('RESET_PASSWORD_URL', '/reset-password'),

        /*
         * Notification class
         */
        'notification' => LaravelAuth\Notifications\ResetPasswordNotification::class,

    ],


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    |
    | You can change route `logout` in section `route`.
    |
    */
    'logout' => [

        /*
         * Route to Log out
         */
        'route' => 'logout',

    ],

];
