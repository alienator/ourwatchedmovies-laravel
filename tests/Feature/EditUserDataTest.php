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
        $user = User::factory()->create();
        $user->name = "Edited user name";

        $res = $this->json('POST', '/api/v1/user', $user->toArray());
        $res->assertStatus(200);
        
        $this->assertNotEmpty($res->json());
    }
}
