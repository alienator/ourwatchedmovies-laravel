<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditUserDataTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_user_can_edit_his_data()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');
        
        $user = User::factory()->create();
        $user->name = "Edited user name";

        $res = $this->json('POST',
                           '/api/v1/user',
                           $user->toArray(),
                           ['token' => $token]);
        $res->assertStatus(200);
        
        $this->assertNotEmpty($res->json());
    }
}
