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

    public function save(\Core\User\User $user, string $password = ''):void {
        $model = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $password
        ]);

        $model->save();
    }
}

