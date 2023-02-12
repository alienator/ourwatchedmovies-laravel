<?php

namespace Tests\Feature;

use App\Models\Score;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class EditScoreTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_score_can_be_added()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $score = Score::factory()->make();
        $score = $score->toArray();

        $res = $this->json('POST', '/api/v1/score', $score, ['token' => $token]);
        $this->assertTrue($res->json());
    }

    public function test_score_can_be_edit()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');
        
        $score = Score::factory()->create();
        $score->value = -2.3;
        $score = $score->toArray();

        $res = $this->json('POST',
                           '/api/v1/score/' . $score['id'],
                           $score,
                           ['token' => $token]);
        $this->assertTrue($res->json());
    }
}
