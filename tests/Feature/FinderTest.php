<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;

class FinderTest extends TestCase
{
    public function test_it_should_fin_in_local_only()
    {
        // $expected = [
        //     $movie1
        //     $movie2
        // ];

        // $criteria = 'smoe movie'

        //url = /api/v1/movies?criteria=CRITERIA?where=local

        //this->json('GET', url, data)
              
        // $localRepo = new LocalMovieRepository();
        // $remoteRepo = new RemoteMovieRepository();
        // $movieService = new \Core\Movie\MovieService($localRepo, $remoteRepo);

        // $actual = $movieService->find($criteria, 'local');

        // assert $expected = $actual

        $expected = Movie::factory()->count(3)->create();
        $c        = $expected[0]->title;

        $res = $this->json('GET', '/api/v1/movie?criteria=' . $c . '&where=local');
        $res->assertStatus(200);

        $res->assertJson(array($expected[0]->getAttributes()));
    }
}
