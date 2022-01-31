<?php

namespace LaravelAuth\Tests\Http\Controllers;

use Laravel\Sanctum\Sanctum;
use LaravelAuth\Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs($this->getUser(), ['*']);
    }

    /**
     * Test logout user.
     *
     * @return void
     */
    public function testLogoutUserSuccessful()
    {
        $response = $this->deleteJson(route('api.logout'));

        $response->assertNoContent();
    }
}
