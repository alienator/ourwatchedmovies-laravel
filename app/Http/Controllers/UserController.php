<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Core\User\UserService;
use Illuminate\Http\Request;
use App\Helpers\Sha256;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService(new UserRepository(), new Sha256());
    }
    
    public function save(Request $req)
    {
        $user = $this->userService->findById($req->id);
        $user->setEmail($req->email);
        $user->setName($req->name);

        $this->userService->save($user, '');

        return ['true'];
    }

    public function findbyId(int $id)
    {
        $ret  = array();
        $user = $this->userService->findById($id);
        if ($user->getId() > 0 ) {
            $ret = [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ];
        }

        return $ret;
    }
}
