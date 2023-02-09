<?php

namespace App\Repositories;

use Core\Movie\Movie as Entity;
use Core\Movie\MovieLocalRepository;

use App\Models\Movie;

class LocalMovieRepository implements MovieLocalRepository
{
    private string $id;
    
    public function find(string $criteria): array
    {
        $res = Movie::where('title', 'LIKE', '%' . $criteria . '%')->get();

        $movies = array();
        foreach ($res as $item) {
            $movies[] = new Entity(
                $item->id,
                $item->title,
                $item->summary,
                $item->releaseDate,
                $item->imagePath,
                $item->globalScore,
                $item->moreInfo,
                $item->watchedDate,
                $item->ourScore
            );
        }

        return $movies;
    }

    public function findById(string $id): Entity
    {
        $res = Movie::where('id', $id)->first();

        if (!$res) return new Entity('', '', '', '', '', 0.0, '', '', 0.0);

        $movie = new Entity(
            $res->id,
            $res->title,
            $res->summary,
            $res->releaseDate,
            $res->imagePath,
            $res->globalScore,
            $res->moreInfo,
            $res->watchedDate,
            $res->ourScore
        );

        return $movie;
    }

    public function save(Entity $entity)
    {
        $movie = new Movie();
        
        $movie->id = $entity->getId();
        $movie->title = $entity->getTitle();
        $movie->summary = $entity->getSummary();
        $movie->releaseDate = $entity->getReleaseDate();
        $movie->imagePath = $entity->getImagePath();
        $movie->globalScore = $entity->getGlobalScore();
        $movie->moreInfo = $entity->getMoreInfo();
        $movie->watchedDate = $entity->getWatchedDate();
        $movie->ourScore = $entity->getOurScore();

        $movie->save();

        $this->id = $movie->id;
    }

    public function getLastInsertedId(): string
    {
        return $this->id;
    }
}
