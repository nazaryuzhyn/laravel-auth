<?php

/*
|--------------------------------------------------------------------------
| Laravel Auth Config
|--------------------------------------------------------------------------
*/
return [

    /*
     * User Resource class
     */
    'user_resource' => LaravelAuth\Http\Resources\UserResource::class,


    /*
     * Prefix to routes
     */
    'prefix_route' => 'api',


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */
    'login' => [

        /*
         * Route to Log in
         */
        'route' => 'login',

        /*
         * Validation rules to Login
         */
        'rules' => [
            'email' => [
                'required_without_all:driver,access_token',
                'string',
            ],
            'password' => [
                'required_without_all:driver,access_token',
                'string',
            ],
            'driver' => [
                'required_without_all:email,password',
                \Illuminate\Validation\Rule::in([
                    'google',
                ]),
            ],
            'access_token' => [
                'required_without_all:email,password',
                'string',
            ],
        ],
    ],


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
            // ...
        ]

    ],


    /*
    |--------------------------------------------------------------------------
    | Signup
    |--------------------------------------------------------------------------
    |
    | If you need added new field to save, just add validation rules down.
    |
    */
    'signup' => [

        /*
         * Route to Sign Up
         */
        'route' => 'signup',

        /*
         * Validation rules to Sign Up
         */
        'rules' => [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:160',
            ],
            'email' => [
                'required',
                'email:rfc,filter',
                'unique:users,email',
                'max:80',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
            ],
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Forgot Password
    |--------------------------------------------------------------------------
    */
    'forgot_password' => [

        /*
         * Route to Forgot Password
         */
        'route' => 'forgot-password',

        /*
         * Validation rules to Forgot Password
         */
        'rules' => [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
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

        /*
         * Validation rules to Reset Password
         */
        'rules' => [
            'token' => [
                'required',
                'string',
                'exists:password_resets,token'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:50',
            ],
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    'logout' => [

        /*
         * Route to Log out
         */
        'route' => 'logout',
    ],

];
