<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthVerifyAccessTest extends TestCase
{
    public function test_return_401_when_access_is_invalid()
    {
        $res = $this->json('GET', '/api/v1/movie');
        $res->assertStatus(401);
    }
}
