<?php

namespace LaravelAuth\Tests\Http\Controllers;

use Laravel\Sanctum\Sanctum;
use LaravelAuth\Models\User;
use LaravelAuth\Tests\TestCase;

/**
 * Class DeleteTokenControllerTest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests\Http\Controllers
 */
class DeleteTokenControllerTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getUser();

        Sanctum::actingAs($this->user, ['*']);
    }

    /**
     * Test delete token.
     *
     * @return void
     */
    public function testDeleteTokenSuccessful()
    {
        $response = $this->deleteJson(route('api.delete-token'), [
            $this->user->currentAccessToken()->id
        ]);

        $response->assertNoContent();
    }
}
