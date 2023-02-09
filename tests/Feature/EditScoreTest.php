<?php

namespace Tests\Feature;

use App\Models\Score;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditScoreTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_score_can_be_added()
    {
        $score = Score::factory()->make();
        $score = $score->toArray();

        $res = $this->json('POST', '/api/v1/score', $score);
        $this->assertTrue($res->json());
    }

    public function test_score_can_be_edit()
    {
        $score = Score::factory()->create();
        $score->value = -2.3;
        $score = $score->toArray();

        $res = $this->json('POST', '/api/v1/score/' . $score['id'], $score);
        $this->assertTrue($res->json());
    }
}
