<?php

namespace LaravelAuth\Tests\Http\Controllers;

use LaravelAuth\Tests\TestCase;

/**
 * Class SignUpControllerTest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests\Http\Controllers
 */
class SignUpControllerTest extends TestCase
{
    protected array $userData;

    public function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'name' => 'Test User',
            'email' => 'email@example.com',
            'password' => 'password',
        ];
    }

    /**
     * Test sign up user.
     *
     * @return void
     */
    public function testSignUpWithValidDataSuccessful()
    {
        $response = $this->postJson(route('api.signup'), $this->userData);

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'user',
            ],
            'message'
        ]);
    }

    /**
     * Test sign up user with not valid data.
     *
     * @return void
     */
    public function testSignUpWithNotValidDataFails()
    {
        $this->userData['email'] = 'notValid@email';
        $response = $this->postJson(route('api.signup'), $this->userData);

        $response->assertUnprocessable();
        $response->assertJsonStructure([
            'errors' => [
                'email',
            ],
            'message'
        ]);
    }
}
