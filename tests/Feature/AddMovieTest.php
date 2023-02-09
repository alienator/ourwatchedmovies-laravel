<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddMovieTest extends TestCase
{
    use RefreshDatabase;
        
    public function test_a_movie_can_be_added_to_our_watched_movies()
    {
        $movie = Movie::factory()->make();
        $movie = $movie->toArray();
        $res = $this->json('POST', '/api/v1/movie', $movie);
        
        $this->assertGreaterThan(0, $res->json());
    }
}
