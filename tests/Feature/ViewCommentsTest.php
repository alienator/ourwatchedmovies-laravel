<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewCommentsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_comments_can_viewed()
    {
        $expected = Comment::factory()->count(3)->create(['movieId' => 'AAA']);
        $movieId = ['movieId' => 'AAA'];

        $res = $this->json('GET', '/api/v1/comment', $movieId);
        $res->assertStatus(200);

        $this->assertEquals($expected->toArray(), $res->json());
    }

    public function test_a_comment_can_be_viewwed()
    {
        $expected = Comment::factory()->create();

        $res = $this->json('GET', '/api/v1/comment/' . $expected['id']);
        $this->assertEquals($expected->toArray(), $res->json());
    }
}
