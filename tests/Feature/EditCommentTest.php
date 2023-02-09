<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditCommentTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_comment_can_be_edited()
    {
        $comment = Comment::factory()->create();
        $comment->comment = 'Edited comment!';
        $comment = $comment->toArray();
        
        $res = $this->json('POST', '/api/v1/comment/' . $comment['id'], $comment);
        $res->assertStatus(200);
    }

}
