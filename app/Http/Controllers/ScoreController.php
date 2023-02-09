<?php

namespace App\Http\Controllers;

use App\Repositories\ScoreRepository;
use Illuminate\Http\Request;

use Core\Score\Score as Entity;
use Core\Score\ScoreService;

class ScoreController extends Controller
{
    public function save(Request $req)
    {
        $score = new Entity(
            0,
            $req->movieId,
            $req->userId,
            $req->value,
            $req->modificationDate
        );

        $repo = new ScoreRepository();
        $scoreService  = new ScoreService($repo);
        $scoreService->save($score);
        
        return 'true';
    }
}
