<?php

return [

    /*
     * Custom User Resource
     */
    'user_resource' => LaravelAuth\Http\Resources\UserResource::class,


    'login' => [

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
         * Custom web url to reset password
         */
        'web_url' => env('RESET_PASSWORD_URL', '/reset-password'),

        /*
         * Custom notification class
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
