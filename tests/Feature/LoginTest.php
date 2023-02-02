<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_users_can_login()
    {
        $user = User::factory()->make();
        $pass = $user->password;
        $user->password = hash('sha256', $user->password);
        $user->save();

        $data = [
            'email' => $user->email,
            'password' =>$pass,
        ];

        $res  = $this->json('POST', 'api/v1/login', $data);

        $res->assertStatus(200);
        $this->assertNotEmpty($res->json('token'));
    }
}
