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
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
            ],
        ],

    ],


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

    ]

];
