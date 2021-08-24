<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Mockery as m;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\SqlServerGrammar;

class DatabaseSqlServerSchemaGrammarTest extends TestCase
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
        $this->assertSame('alter table "users" add "foo" nchar(26) not null', $statements[0]);
    }

    public function testAddingForeignUlid()
    {
        $blueprint = new Blueprint('users');
        $foreignId = $blueprint->foreignUlid('foo');
        $blueprint->foreignUlid('company_id')->constrained();
        $blueprint->foreignUlid('laravel_idea_id')->constrained();
        $blueprint->foreignUlid('team_id')->references('id')->on('teams');
        $blueprint->foreignUlid('team_column_id')->constrained('teams');

        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertInstanceOf(ForeignIdColumnDefinition::class, $foreignId);
        $this->assertSame([
            'alter table "users" add "foo" nchar(26) not null, "company_id" nchar(26) not null, "laravel_idea_id" nchar(26) not null, "team_id" nchar(26) not null, "team_column_id" nchar(26) not null',
            'alter table "users" add constraint "users_company_id_foreign" foreign key ("company_id") references "companies" ("id")',
            'alter table "users" add constraint "users_laravel_idea_id_foreign" foreign key ("laravel_idea_id") references "laravel_ideas" ("id")',
            'alter table "users" add constraint "users_team_id_foreign" foreign key ("team_id") references "teams" ("id")',
            'alter table "users" add constraint "users_team_column_id_foreign" foreign key ("team_column_id") references "teams" ("id")',
        ], $statements);
    }

    public function getGrammar()
    {
        return new SqlServerGrammar;
    }
}
