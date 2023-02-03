<?php

namespace Tests\Feature;

use App\Repositories\RemoteMovieRepository;
use Tests\TestCase;

class MovieRemoteRepositoryTest extends TestCase
{
    public function test_amovie_can_be_finded()
    {   
        $criteria = "ghost";
        
        $repo = new RemoteMovieRepository();
        $res  = $repo->find($criteria);

        $this->assertGreaterThan(0, count($res));
    }
}
