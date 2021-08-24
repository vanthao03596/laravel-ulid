<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Vanthao03596\LaravelUlid\LaravelUlidServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Vanthao03596\\LaravelUlid\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->setupDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelUlidServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function setupDatabase($app)
    {
        Schema::dropAllTables();

        $app['db']->connection()->getSchemaBuilder()->create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->ulid('ulid')->nullable();
            $table->string('title');
        });

        $app['db']->connection()->getSchemaBuilder()->create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->ulid('custom_ulid')->nullable();
            $table->ulid('other_custom_ulid')->nullable();
            $table->string('comment');
        });
    }
}
