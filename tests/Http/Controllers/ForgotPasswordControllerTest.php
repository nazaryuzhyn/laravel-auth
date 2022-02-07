<?php

namespace LaravelAuth\Tests\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;
use LaravelAuth\Models\User;
use LaravelAuth\Notifications\ResetPasswordNotification;
use LaravelAuth\Tests\TestCase;

/**
 * Class ForgotPasswordControllerTest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests\Http\Controllers
 */
class ForgotPasswordControllerTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getUser();

        Sanctum::actingAs($this->user, ['*']);

        Notification::fake();
    }

    /**
     * Test forgot password with valid email user.
     *
     * @return void
     */
    public function testForgotPasswordSuccessful()
    {
        $response = $this->postJson(route('api.forgot-password'), [
            'email' => $this->user->email
        ]);

        $response->assertOk()
            ->assertJsonFragment([
                'message' => 'Success',
            ]);

        Notification::assertSentTo($this->user, ResetPasswordNotification::class);
    }

    /**
     * Test forgot password with wrong email user.
     *
     * @return void
     */
    public function testForgotPasswordWithWrongEmail()
    {
        $response = $this->postJson(route('api.forgot-password'), [
            'email' => 'wrong@email.com'
        ]);

        $response->assertInvalid(['email']);
    }
}
