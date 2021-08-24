<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Ulid\Ulid;

class SupportStrTest extends TestCase
{
    public function testUlid()
    {
        $this->assertInstanceOf(Ulid::class, Str::ulid());
        $datetime = Carbon::now()->subHour();
        $this->assertSame($datetime->getTimestamp() * 1000, Str::ulid(false, $datetime)->toTimestamp());
    }
}
