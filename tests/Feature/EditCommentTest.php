<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class EditCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_comment_can_be_edited()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $comment = Comment::factory()->create();
        $comment->comment = 'Edited comment!';
        $comment = $comment->toArray();

        $res = $this->json(
            'POST',
            '/api/v1/comment/' . $comment['id'],
            $comment,
            ['token' => $token]
        );
        $res->assertStatus(200);
    }
}
