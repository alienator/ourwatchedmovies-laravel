<?php

namespace App\Http\Controllers;

use App\Repositories\ScoreRepository;
use Illuminate\Http\Request;

use Core\Score\Score as Entity;
use Core\Score\ScoreService;

class ScoreController extends Controller
{
    private ScoreService $scoreService;

    public function __construct()
    {
        $this->scoreService    = new ScoreService(new ScoreRepository());
    }
    
    public function save(Request $req, $id = 0)
    {
        $score = new Entity(
            $id,
            $req->movieId,
            $req->userId,
            $req->value,
            $req->modificationDate
        );

        $this->scoreService->save($score);
        
        return 'true';
    }

    public function findByMovieId(Request $req)
    {
        $movieId = $req->movieId;
        $scores = array();
        $res    = $this->scoreService->findByMovieId($movieId);
        foreach($res as $item) {
            $scores[] = [
                'id' => $item->getId(),
                'userId' => $item->getUSerId(),
                'movieId' => $item->getMovieId(),
                'value' => $item->getValue(),
                'modificationDate' => $item->getModificationDate()
            ];
        }

        return $scores;
    }

    public function findByid($id)
    {
        $res = $this->scoreService->findById($id);
        $score = new Entity(0, '', 0, 0.0, '');
        if ($res) {
            $score = [
                'id' => $res->getId(),
                'movieId' => $res->getMovieId(),
                'userId' => $res->getUserId(),
                'value' => $res->getValue(),
                'modificationDate' => $res->getModificationDate()
            ];
        }

        return $score;
    }
}
