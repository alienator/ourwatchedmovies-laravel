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
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');
        
        $data = [
            'token' => 'ABCD123'
        ];

        $res = $this->json('POST',
                           'api/v1/logout',
                           $data,
                           ['token' => $token]);

        $res->assertStatus(200);
        $this->assertTrue($res->json());
    }
}
