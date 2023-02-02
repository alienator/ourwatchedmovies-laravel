<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements \Core\User\UserRepository
{
    private \Core\User\User $entity;
    
    public function findByEmailAndPassword(string $email, string $password)
    {
        $user = User::where('password', $password)->first();
        
        if ($user) {
            $this->entity = new \Core\User\User(
                $user->id,
                $user->name,
                $user->email);
        } else {
            return null;
        }
        
        return $this->entity;
    }

    public function save($user, string $password = ''):void {
    }
}

