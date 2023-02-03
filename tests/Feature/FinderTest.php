<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FinderTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_should_fin_in_local_only()
    {
        $expected = Movie::factory()->count(3)->create();
        $c        = $expected[0]->title;

        $res = $this->json('GET', '/api/v1/movie?criteria=' . $c . '&where=local');
        $res->assertStatus(200);

        $res->assertJson(array($expected[0]->getAttributes()));
    }
}
