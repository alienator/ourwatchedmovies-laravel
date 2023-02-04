<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieDetailsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_details_of_a_local_movie_can_be_obtained()
    {
        $movie = Movie::factory()->create();
        $id = $movie->id;

        $details = $movie->getAttributes();

        $res = $this->json('GET', '/api/v1/movie/' . $id);
        $res->assertStatus(200);

        $res->assertJson($details);
    }

    public function test_details_of_a_remote_movie_can_be_obtained()
    {
        $id = 'tt0099653'; //Omdb id for ghost

        $res = $this->json('GET', '/api/v1/movie/' . $id);
        $res->assertStatus(200);

        $this->assertNotEmpty($res->json());
    }

}
