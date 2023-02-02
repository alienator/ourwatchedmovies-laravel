<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IsUserLogedTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_ahould_return_true_when_a_user_is_loged()
    {
        $user = User::factory()->make();
        $pass = $user->password;
        $user->password = hash('sha256', $pass);
        $user->save();

        $data = [
            'email' => $user->email,
            'password' => $pass,
        ];

        $this->json('POST', '/api/v1/login', $data);

        $res = $this->json('GET', '/api/v1/isUserLoged', $data);

        $res->assertStatus(200);
        $this->assertEquals($res->json(), 1);
    }

    public function test_it_should_return_false_when_a_user_is_not_loged()
    {
        if(!session_id()) session_start();
        session_destroy();
        
        $res = $this->json('GET', '/api/v1/isUserLoged');

        $res->assertStatus(200);
        $res->assertContent('');
    }

}
