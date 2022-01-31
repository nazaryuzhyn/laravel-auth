<?php

namespace LaravelAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ForgotPasswordRequest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Requests
 */
class ForgotPasswordRequest extends FormRequest
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
                'required',
                'email',
                'exists:users,email'
            ],
        ];
    }
}
