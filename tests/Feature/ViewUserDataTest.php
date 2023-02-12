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
        $user = User::factory()->create();
        unset($user->password);
        
        $res = $this->json('GET', '/api/v1/user/' . $user->id, $user->toArray());
        $res->assertStatus(200);

        $this->assertEquals($user->toArray(), $res->json());
    }
}
