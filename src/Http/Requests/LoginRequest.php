<?php

namespace LaravelAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
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
                Rule::in(
                    array_keys(
                        config('laravel-auth.socialite.providers')
                    )
                ),
            ],
            'access_token' => [
                'required_without_all:email,password',
                'string',
            ],
        ];
    }
}
