<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Mockery as m;
use Illuminate\Database\Schema\Blueprint;

class DatabaseSQLiteSchemaGrammarTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testAddingUlid()
    {
        $blueprint = new Blueprint('users');
        $blueprint->ulid('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertCount(1, $statements);
        $this->assertSame('alter table "users" add column "foo" varchar not null', $statements[0]);
    }

    public function testAddingForeignUlid()
    {
        $blueprint = new Blueprint('users');
        $foreignUuid = $blueprint->foreignUlid('foo');
        $blueprint->foreignUlid('company_id')->constrained();
        $blueprint->foreignUlid('laravel_idea_id')->constrained();
        $blueprint->foreignUlid('team_id')->references('id')->on('teams');
        $blueprint->foreignUlid('team_column_id')->constrained('teams');

        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertInstanceOf(ForeignIdColumnDefinition::class, $foreignUuid);
        $this->assertSame([
            'alter table "users" add column "foo" varchar not null',
            'alter table "users" add column "company_id" varchar not null',
            'alter table "users" add column "laravel_idea_id" varchar not null',
            'alter table "users" add column "team_id" varchar not null',
            'alter table "users" add column "team_column_id" varchar not null',
        ], $statements);
    }

    public function getGrammar()
    {
        return new SQLiteGrammar;
    }
}
