<?php

namespace LaravelAuth\Helpers;

use Illuminate\Support\Facades\Hash;

/**
 * Trait HasAuthentication.
 *
 * @property $attributes
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Helpers
 */
trait HasAuthentication
{
    /**
     * Set user's password with subsequent hashing.
     *
     * @param string|null $password
     * @return void
     */
    public function setPasswordAttribute(?string $password): void
    {
        if (is_null($password)) {
            $this->attributes['password'] = null;

            return;
        }

        $this->attributes['password'] = Hash::make($password);
    }
}
