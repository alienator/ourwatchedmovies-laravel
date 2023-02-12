<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AddMovieTest extends TestCase
{
    use RefreshDatabase;
        
    public function test_a_movie_can_be_added_to_our_watched_movies()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json(
            'POST',
            '/api/v1/login',
            ['email' => $user->email, 'password' => '123']
        );
        $token = $res->json('token');

        
        $movie = Movie::factory()->make();
        $movie = $movie->toArray();
        $res = $this->json('POST', '/api/v1/movie', $movie, ['token' => $token]);
        
        $this->assertNotEmpty($res->json());
    }
}
