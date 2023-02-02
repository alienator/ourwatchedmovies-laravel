<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_users_can_logout()
    {
        $data = [
            'token' => 'ABCD123'
        ];

        $res = $this->json('POST', 'api/v1/logout', $data);

        $res->assertStatus(200);
        $this->assertTrue($res->json());
    }
}
