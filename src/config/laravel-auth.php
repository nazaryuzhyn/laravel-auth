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

];
