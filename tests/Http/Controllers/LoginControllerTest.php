<?php

namespace LaravelAuth\Tests\Http\Controllers;

use LaravelAuth\Tests\TestCase;

class LoginControllerTest extends TestCase
{
    protected array $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->getUser();

        $this->user = [
            'email' => 'john.doe@email.com',
            'password' => 'password'
        ];
    }

    /**
     * Test login user.
     *
     * @return void
     */
    public function testLoginWithValidDataSuccessful()
    {
        $response = $this->postJson(route('api.login'), $this->user);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'user',
            ],
            'message',
        ]);
    }

    /**
     * Test login user with wrong password.
     *
     * @return void
     */
    public function testLoginWithWrongPassword()
    {
        $this->user['password'] = 'wrong-password';
        $response = $this->postJson(route('api.login'), $this->user);

        $response->assertUnauthorized();
        $response->assertJsonFragment([
            'message' => 'Email or password is incorrect',
        ]);
    }

    /**
     * Test login user with wrong email.
     *
     * @return void
     */
    public function testLoginWithWrongEmail()
    {
        $this->user['email'] = 'wrong@email.com';
        $response = $this->postJson(route('api.login'), $this->user);

        $response->assertUnauthorized();
        $response->assertJsonFragment([
            'message' => 'Email or password is incorrect',
        ]);
    }

    /**
     * Test login user with not valid data.
     *
     * @return void
     */
    public function testLoginWithNotValidDataFails()
    {
        $this->user['password'] = 'wrong-password';
        $response = $this->postJson(route('api.login'), $this->user);

        $response->assertUnauthorized();
        $response->assertJsonFragment([
            'message' => 'Email or password is incorrect',
        ]);
    }
}
