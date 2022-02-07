<?php

namespace LaravelAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordRequest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Requests
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
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
        ];
    }
}
