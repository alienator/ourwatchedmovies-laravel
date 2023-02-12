<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    
    public function save(Request $req)
    {
        $user = $this->userRepository->findById($req->id);
        $user->setEmail($req->email);
        $user->setName($req->name);

        $this->userRepository->save($user);

        return ['true'];
    }
}
