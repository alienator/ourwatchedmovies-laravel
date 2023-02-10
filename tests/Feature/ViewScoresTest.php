<?php

namespace Tests\Feature;

use App\Models\Score;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewScoresTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_scores_for_a_movie_can_be_finded()
    {
        $movieId = 'AAA';
        $scores = Score::factory()->count(3)->create(['movieId' => $movieId]);

        $res = $this->json('GET', '/api/v1/score?movieId=' . $movieId);
        $this->assertEquals($scores->toArray(), $res->json());
    }

    public function test_score_can_be_finded()
    {
        $score = Score::factory()->create();
        $scoreId = $score->id;

        $res = $this->json('GET', '/api/v1/score/' . $scoreId);
        $this->assertEquals($score->toArray(), $res->json());
    }
}
