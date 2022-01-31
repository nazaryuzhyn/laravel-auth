<?php

namespace LaravelAuth\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminated\Testing\TestingTools;
use LaravelAuth\Models\User;
use LaravelAuth\Providers\LaravelAuthServiceProvider;

/**
 * Class TestCase.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use TestingTools;
    use RefreshDatabase;
    use SetUpDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * Get package providers.
     *
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelAuthServiceProvider::class,
        ];
    }

    /**
     * Get user.
     *
     * @return mixed
     */
    public function getUser(): mixed
    {
        $model = config('laravel-auth.user_model') ?? User::class;

        return $model::query()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'email_verified_at' => now(),
            'password' => 'password',
        ]);
    }
}
