<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
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
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelUlidServiceProvider::class,
        ];
    }

//    public function getEnvironmentSetUp($app)
//    {
//        config()->set('database.default', 'testing');
//
//        $migration = include __DIR__.'/../database/migrations/create_laravel-ulid_table.php.stub';
//        $migration->up();
//    }
}
