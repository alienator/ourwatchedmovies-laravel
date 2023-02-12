<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_comment_can_be_added()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $movie = Movie::factory()->create();

        $res = $this->json(
            'POST',
            '/api/v1/login',
            ['email' => $user->email, 'password' => '123']
        );
        $token = $res->json('token');
        $comment = Comment::factory()->make();
        $comment->movieId = $movie->id;
        $comment->userId  = $user->id;
        $comment = $comment->toArray();

        $res = $this->json('POST', '/api/v1/comment', $comment, ['token' => $token]);
        $res->assertStatus(200);
        $res->assertJson(['true']);
    }
}
