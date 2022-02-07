<?php

namespace LaravelAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SignUpRequest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Requests
 */
class SignUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
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
        ];
    }
}
