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
    | Login
    |--------------------------------------------------------------------------
    |
    | After using this package you can change the route `login`,
    | in section `route`. It is also possible to change validation rules.
    | If you add a new social provider, don't forget to add to
    | validation rules in section `driver` after `google` driver.
    |
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
    | Also, you can change the route `signup`, in section `route`.
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
    |
    | You can change route `forgot-password` in section `route`.
    | It is also possible to change validation rules.
    |
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
    |
    | You can change route `reset-password` in section `route`.
    | It is also possible to change the web_url that comes
    | in the password reset email.
    | In section `notification` you can change class on your.
    | Also, can change validation rules.
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
