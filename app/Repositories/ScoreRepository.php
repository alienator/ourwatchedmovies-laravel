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

    /**
     * @return array(Entity)
     */
    public function findByMovieId(string $movieId): array
    {
        $scores = array();
        $res = Score::where('movieId', $movieId)->get();
        foreach ($res as $item) {
            $scores[] = new Entity(
                $item->id,
                $item->movieId,
                $item->userId,
                $item->value,
                $item->modificationDate
            );
        }

        return $scores;
    }

    public function findById(int $id): Entity
    {
        $score =  new Entity(0, '', 0, 0.0, '');
        $model = Score::where('id', $id)->first();
        if ($model) {
            $score->setId($model->id);
            $score->setMovieId($model->movieId);
            $score->setUserId($model->userId);
            $score->setValue($model->value);
            $score->setModificationDate($model->modificationDate);
        }

        return $score;
    }
}
