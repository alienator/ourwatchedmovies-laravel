<?php

namespace App\Repositories;

use App\Models\User;
use Core\User\User as Entity;

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
                $user->email,
                $user->imagePath);
        } else {
            return null;
        }
        
        return $this->entity;
    }

    public function save(\Core\User\User $user, string $password = ''):void {
        if ($user->getId() == 0) {
            $model = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'imagePath' => $user->getImagePath(),
                'password' => $password
            ]);
        } else {
            $model = User::find($user->getId());
            $model->name = $user->getName();
            $model->email = $user->getEmail();
            $model->imagePath = $user->getImagePath();
            $model->password = ($password) ? $password : $model->password;
        }
        
        $model->save();
    }

    public function findById(int $id): Entity
    {
        $entity = new Entity(0, '', '');
        $model = User::where('id', $id)->first();

        if ($model) {
            $entity = new Entity(
                $model->id,
                $model->name,
                $model->email,
                $model->imagePath
            );
        }

        return $entity;
    }
}

