<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinderTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_should_find_movies_in_local()
    {
        $expected = Movie::factory()->count(3)->create();
        $c        = $expected[0]->title;

        $res = $this->json('GET', '/api/v1/movie?criteria=' .
                           $c . '&where=local');
        $res->assertStatus(200);

        $res->assertJson(array($expected[0]->getAttributes()));
    }

    public function test_it_should_find_movies_in_remote()
    {
        $c = 'ghost';

        $res = $this->json('GET', '/api/v1/movie?criteria=' .
                           $c . '&where=remote');
        $res->assertStatus(200);

        $this->assertGreaterThan(0, count($res->json()));
    }

    public function test_it_should_find_movies_in_remote_and_local()
    {
        $c = 'ghost';

        $res = $this->json('GET', '/api/v1/movie?criteria=' .
                           $c . '&where=all');
        $res->assertStatus(200);

        $this->assertGreaterThan(0, count($res->json()));
    }

}
