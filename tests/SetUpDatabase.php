<?php

namespace LaravelAuth\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;

/**
 * Trait SetUpDatabase.
 *
 * @author Nazar Yuzhyn <nazaryuzhyn@gmail.com>
 * @package LaravelAuth\Tests
 */
trait SetUpDatabase
{
    /**
     * @param Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('users', static function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('password_resets', static function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });

        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('personal_access_tokens', static function (Blueprint $table) {
                $table->id();
                $table->morphs('tokenable');
                $table->string('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamps();
            });
    }
}
