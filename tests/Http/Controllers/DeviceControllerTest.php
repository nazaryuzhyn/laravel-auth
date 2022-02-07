<?php

namespace LaravelAuth\Tests\Http\Controllers;

use Laravel\Sanctum\Sanctum;
use LaravelAuth\Tests\TestCase;

/**
 * Class DeviceControllerTest.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests\Http\Controllers
 */
class DeviceControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Sanctum::actingAs($this->getUser(), ['*']);
    }

    /**
     * Test get devices the user.
     *
     * @return void
     */
    public function testGetDevicesUserSuccessful()
    {
        $response = $this->getJson(route('api.devices'));

        $response->assertOk()
            ->assertJsonCount(1);
    }
}
