<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewUserDataTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_user_can_view_his_data()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $user = User::factory()->create();
        unset($user->password);
        
        $res = $this->json('GET',
                           '/api/v1/user/' . $user->id,
                           $user->toArray(),
                           ['token' => $token]);
        $res->assertStatus(200);

        $this->assertEquals($user->toArray(), $res->json());
    }
}
