<?php

namespace LaravelAuth\Tests\Http\Controllers;

use Illuminate\Support\Str;
use LaravelAuth\Models\PasswordReset;
use LaravelAuth\Models\User;
use LaravelAuth\Tests\TestCase;

/**
 * Class ResetPasswordControllerTest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests\Http\Controllers
 */
class ResetPasswordControllerTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getUser();
    }

    /**
     * Test reset password user.
     *
     * @return void
     */
    public function testResetPasswordSuccessful()
    {
        /** @var PasswordReset $passwordReset */
        $passwordReset = PasswordReset::query()->create([
            'email' => $this->user->email,
            'token' => Str::random(60)
        ]);

        $response = $this->postJson(route('api.reset-password'), [
            'token' => $passwordReset->token,
            'password' => 'new_password'
        ]);

        $response->assertOk()
            ->assertJsonFragment([
                'message' => 'Success',
            ]);
    }
}
