<?php

namespace Vanthao03596\LaravelUlid\Tests;

use Illuminate\Database\Eloquent\Model;
use Vanthao03596\LaravelUlid\GeneratesUlid;

class GenerateUlidTest extends TestCase
{
    public function testSetUlidWhenCreateNewModel()
    {
        $post = Post::create(['title' => 'Test post']);

        $this->assertNotNull($post->ulid);
    }

    public function testDoesNotOverridTheUlidIfItAlreadySet()
    {
        $ulid = '01fdw451ch10nge8b0gkjx553q';

        $post = Post::create(['title' => 'Test post', 'ulid' => $ulid]);

        $this->assertSame($ulid, $post->ulid);
    }

    public function testAllowConfigurableUlidColumnName()
    {
        $comment = Comment::create(['comment' => 'Test comment']);

        $this->assertNotNull($comment->custom_ulid);
    }

    public function testMultipleUlidColumnNames()
    {
        $comment = Comment::create(['comment' => 'Test comment']);

        $this->assertNotNull($comment->custom_ulid);
        $this->assertNotNull($comment->other_custom_ulid);
    }
}

class Post extends Model
{
    use GeneratesUlid;
    protected $guarded = [];

    public $timestamps = false;
}

class Comment extends Model
{
    use GeneratesUlid;
    protected $guarded = [];

    public $timestamps = false;

    public function ulidColumns(): array
    {
        return ['custom_ulid', 'other_custom_ulid'];
    }
}
