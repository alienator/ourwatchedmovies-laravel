<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ViewCommentsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_comments_can_viewed()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $expected = Comment::factory()->count(3)->create(['movieId' => 'AAA']);
        $movieId = ['movieId' => 'AAA'];

        $res = $this->json('GET', '/api/v1/comment', $movieId, ['token' => $token]);
        $res->assertStatus(200);

        $this->assertEquals($expected->toArray(), $res->json());
    }

    public function test_a_comment_can_be_viewwed()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');
        
        $expected = Comment::factory()->create();

        $res = $this->json('GET',
                           '/api/v1/comment/' . $expected['id'],
                           [],
                           ['token' => $token]);
        $res->assertStatus(200);
        $this->assertEquals($expected->toArray(), $res->json());
    }
}
