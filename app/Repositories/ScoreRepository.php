<?php

namespace App\Repositories;

use App\Models\Score;
use Core\Score\ScoreRepository as ScoreScoreRepository;
use Core\Score\Score as Entity;

class ScoreRepository implements ScoreScoreRepository
{
    public function save(Entity $score): void
    {
        if ($score->getId() > 0)
            $model = Score::find($score->getId());
        else
            $model = new Score();
        
        $model->userId = $score->getUserId();
        $model->movieId = $score->getMovieId();
        $model->value  = $score->getValue();
        $model->modificationDate = $score->getModificationDate();

        $model->save();
    }
}
