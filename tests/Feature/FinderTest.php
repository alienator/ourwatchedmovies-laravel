<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class FinderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_find_movies_in_local()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json(
            'POST',
            '/api/v1/login',
            ['email' => $user->email, 'password' => '123']
        );
        $token = $res->json('token');

        $expected = Movie::factory()->count(3)->create();
        $c        = $expected[0]->title;

        $res = $this->json(
            'GET',
            '/api/v1/movie?criteria=' .
                $c . '&where=local',
            [],
            ['token' => $token]
        );
        $res->assertStatus(200);

        $res->assertJson(array($expected[0]->getAttributes()));
    }

    public function test_it_should_find_movies_in_remote()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json(
            'POST',
            '/api/v1/login',
            ['email' => $user->email, 'password' => '123']
        );
        $token = $res->json('token');

        $c = 'ghost';

        $res = $this->json(
            'GET',
            '/api/v1/movie?criteria=' .
                $c . '&where=remote',
            [],
            ['token' => $token]
        );
        $res->assertStatus(200);

        $this->assertGreaterThan(0, count($res->json()));
    }

    public function test_it_should_find_movies_in_remote_and_local()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json(
            'POST',
            '/api/v1/login',
            ['email' => $user->email, 'password' => '123']
        );
        $token = $res->json('token');
        
        $c = 'ghost';

        $res = $this->json('GET', '/api/v1/movie?criteria=' .
                           $c . '&where=all',
                           [],
                           ['token' => $token]);
        $res->assertStatus(200);

        $this->assertGreaterThan(0, count($res->json()));
    }
}
