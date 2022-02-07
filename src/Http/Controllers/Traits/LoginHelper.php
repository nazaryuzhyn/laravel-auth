<?php

namespace LaravelAuth\Http\Controllers\Traits;

use App\Models\User;
use LaravelAuth\Http\Requests\LoginRequest;

/**
 * Trait LoginHelper.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Http\Controllers\Traits
 */
trait LoginHelper
{
    /**
     * Resource class.
     *
     * @var string
     */
    protected string $resource;

    /**
     * Model class.
     *
     * @var string
     */
    protected string $model;

    /**
     * Determine auth method.
     *
     * @param string $method
     * @return bool
     */
    protected function hasAuthMethod(string $method): bool
    {
        return config('laravel-auth.auth_method') === $method;
    }

    /**
     * Get access token for the user.
     *
     * @param $user
     * @return string|null
     */
    protected function getAccessToken($user): ?string
    {
        if ($this->hasAuthMethod('token')) {
            return $user->createToken(request()->userAgent())->plainTextToken;
        }

        return null;
    }
}
