<?php

namespace App\Http\Controllers;

use App\Helpers\NetClient;
use App\Repositories\AuthRepository;
use App\Helpers\Sha256;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $userRepository = new UserRepository();
        $netCient       = new NetClient($req);
        $authRepository = new AuthRepository();
        $sha256         = new Sha256();
        $dt             = date('Y-m-d H:i:s');

        $auth = new \Core\Auth\AuthService(
            $userRepository,
            $netCient,
            $authRepository,
            $sha256
        );

        $token = $auth->login($req->email, $sha256->hash($req->password), $dt);
        return ['token' => $token];
    }

    public function logout(Request $req)
    {
        $token = $req->token;

        $userRepository = new UserRepository();
        $netCient       = new NetClient($req);
        $authRepository = new AuthRepository();
        $sha256         = new Sha256();

        $auth = new \Core\Auth\AuthService(
            $userRepository,
            $netCient,
            $authRepository,
            $sha256
        );

        return ($auth->logout($token)) ? 'true' : 'false';
    }

    public function isUserLoged()
    {
        if(!session_id()) session_start();
        return array_key_exists('token', $_SESSION);
    }
}
