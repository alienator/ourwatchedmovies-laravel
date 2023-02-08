<?php

namespace App\Repositories;

use App\Models\AuthSession;

class AuthRepository implements \Core\Auth\AuthRepository
{
    public function save(\Core\User\User $user, string $token): void {
        AuthSession::create([
            'user_id' => $user->getId(),
            'token'   => $token
        ]);

        
        // if(!session_id()) session_start();
        
        // session_regenerate_id();
        // $_SESSION['id'] = $user->getId();
        // $_SESSION['token'] = $token;
    }
    
    public function destroy(string $token): void {
        AuthSession::where('token', $token)->delete();
    }

    public function get(string $token): array {
        $authSession = AuthSession::where('token', $token)->first();
        return ($authSession) ?
            ['user_id' => $authSession->user_id,
             'token' => $authSession->token] : [];
    }
}
