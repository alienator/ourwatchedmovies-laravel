<?php

namespace App\Repositories;

class AuthRepository implements \Core\Auth\AuthRepository
{
    public function save(\Core\User\User $user, string $token): void {
        session_start();
        session_regenerate_id();
        $_SESSION['id'] = $user->getId();
        $_SESSION['token'] = $token;
    }
    
    public function destroy(string $token): void {
    }

}
