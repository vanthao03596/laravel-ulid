<?php

namespace Vanthao03596\LaravelUlid;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Ulid\Ulid;
use Illuminate\Database\Schema\Grammars\Grammar;
use RuntimeException;
use Illuminate\Database\Schema\ColumnDefinition;

class LaravelUlidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Grammar::macro('typeUlid', function () {
            switch (class_basename(static::class)) {
                case 'PostgresGrammar':
                case 'MySqlGrammar':
                    return 'char(26)';

                case 'SQLiteGrammar':
                    return 'varchar';

                case 'SqlServerGrammar':
                    return 'nchar(26)';

                default:
                    throw new RuntimeException('This database is not supported.');
            }
        });

        Blueprint::macro('ulid', function ($column): ColumnDefinition {
            /* @var Blueprint $this */
            return $this->addColumn('ulid', $column);
        });

        Blueprint::macro('foreignUlid', function ($column): ColumnDefinition {
            /* @var Blueprint $this */
            return $this->addColumnDefinition(new ForeignIdColumnDefinition($this, [
                'type' => 'ulid',
                'name' => $column,
            ]));
        });

        Blueprint::macro('ulidMorphs', function ($name, $indexName = null) {
            /* @var Blueprint $this */
            $this->string("{$name}_type");

            $this->ulid("{$name}_id");

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        });

        Blueprint::macro('nullableUlidMorphs', function ($name, $indexName = null) {
            /* @var Blueprint $this */
            $this->string("{$name}_type")->nullable();

            $this->ulid("{$name}_id")->nullable();

            $this->index(["{$name}_type", "{$name}_id"], $indexName);
        });

        Str::macro('ulid', function (bool $lowercase = true, string $dateTime = null) {
            return $dateTime
                ? Ulid::fromTimestamp(strtotime($dateTime) * 1000, $lowercase)
                : Ulid::generate($lowercase);
        });
    }
}
