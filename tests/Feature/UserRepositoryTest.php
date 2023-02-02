<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Repositories\UserRepository;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test a user repository
     * @return void
     **/
    public function test_find_by_email_and_password()
    {
        $this->seed(UserSeeder::class);

        $name  = 'test';
        $email = 'aa@aa.com';
        $pass  = 'A665A45920422F9D417eE4867EFDC4FB8A04A1F3FFF1FA07E998E86F7F7A27AE3'; // sha256(123)
        
        $expected = new \Core\User\User(1, $name, $email);
        
        $repo = new UserRepository();
        $user = $repo->findByEmailAndPassword($email, $pass);
        
        $this->assertEquals($expected, $user);
    }
}
