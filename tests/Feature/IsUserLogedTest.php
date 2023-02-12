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
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');

        $user = User::factory()->make();
        $pass = $user->password;
        $user->password = hash('sha256', $pass);
        $user->save();

        $data = [
            'email' => $user->email,
            'password' => $pass,
        ];

        $token = $this->json('POST', '/api/v1/login', $data);
        $token = $token->json()['token'];
        
        $res = $this->json('GET',
                           '/api/v1/isUserLoged?token=' . $token,
                           [],
                           ['token' => $token]);
        $res->assertStatus(200);
        
        $this->assertEquals($res->json(), 1);
    }

    public function test_it_should_return_false_when_a_user_is_not_loged()
    {
        $pass = hash('sha256', '123');
        $user = User::factory()->create(['password' => $pass]);
        $res = $this->json('POST',
                           '/api/v1/login',
                           ['email' => $user->email, 'password' => '123']);
        $token = $res->json('token');
        
        $token = 'BAD_TOKEN';
        
        $res = $this->json('GET',
                           '/api/v1/isUserLoged?token=' .$token,
                           [],
                           ['token' => $token]);

        $res->assertStatus(200);
        $res->assertContent('');
    }

}
