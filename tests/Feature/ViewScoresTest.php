<?php

namespace Tests\Feature;

use App\Models\Score;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ViewScoresTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_scores_for_a_movie_can_be_finded()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $movieId = 'AAA';
        $scores = Score::factory()->count(3)->create(['movieId' => $movieId]);

        $res = $this->json('GET',
                           '/api/v1/score?movieId=' . $movieId,
                           [],
                           ['token' => $token]);
        $this->assertEquals($scores->toArray(), $res->json());
    }

    public function test_score_can_be_finded()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $score = Score::factory()->create();
        $scoreId = $score->id;

        $res = $this->json('GET',
                           '/api/v1/score/' . $scoreId,
                           [],
                           ['token' => $token]);
        $this->assertEquals($score->toArray(), $res->json());
    }
}
