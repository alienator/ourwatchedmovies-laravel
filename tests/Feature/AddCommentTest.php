<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;

class AddCommentTest extends TestCase
{
    public function test_a_comment_can_be_added()
    {
        $user = User::factory()->create();
        
        $movie = Movie::factory()->create();
        
        $comment = Comment::factory()->make();
        $comment->movieId = $movie->id;
        $comment->userId  = $user->id;
        $comment = $comment->toArray();

        $res = $this->json('POST', '/api/v1/comment', $comment);
        $res->assertStatus(200);
        $res->assertJson(true);
        
    }
}
