<?php

return [

    'user_resource' => LaravelAuth\Http\Resources\UserResource::class,

    'login' => [

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
