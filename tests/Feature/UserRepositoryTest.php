<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Repositories\UserRepository;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
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
        $iamgePath = 'user.png';
        $pass  = 'A665A45920422F9D417eE4867EFDC4FB8A04A1F3FFF1FA07E998E86F7F7A27AE3'; // sha256(123)
        
        $expected = new \Core\User\User(1, $name, $email, $iamgePath);
        
        $repo = new UserRepository();
        $user = $repo->findByEmailAndPassword($email, $pass);
        
        $this->assertEquals($expected, $user);
    }

    public function test_it_should_insert_an_user()
    {
        $name  = 'test2';
        $email = 'aa@bb.com';
        $pass  = '123BB';
        
        $user = new \Core\User\User(0, $name, $email);
        
        $repo = new UserRepository();
        $repo->save($user, $pass);
        
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'password' => $pass
        ]);
    }

    public function test_it_should_update_a_user()
    {
        $this->seed(UserSeeder::class);
        
        $name  = 'test2';
        $email = 'aa@bb.com';
        $pass  = '123BB';
        
        $user = new \Core\User\User(1, $name, $email);
        
        $repo = new UserRepository();
        $repo->save($user, $pass);
        
        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => $name,
            'email' => $email,
            'password' => $pass
        ]);
    }
    
}
