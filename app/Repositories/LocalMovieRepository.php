<?php

namespace App\Repositories;

use Core\Movie\Movie as Entity;
use Core\Movie\MovieLocalRepository;

use App\Models\Movie;
use Core\Movie\Movie as MovieMovie;
use Dotenv\Parser\Entry;

class LocalMovieRepository implements MovieLocalRepository
{
    public function find(string $criteria): array
    {
        $res = Movie::where('title', 'LIKE', '%' . $criteria . '%')->get();

        $movies = array();
        foreach ($res as $item) {
            $movies[] = new MovieMovie(
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

    public function findById(string $id)
    {
        $res = Movie::where('id', $id)->first();

        if(!$res) return null;
        
        $movie = new Entity (
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
    
    public function save(Entity $movie)
    {
    }
    
    public function getLastInsertedId(): int
    {
        return 0;
    }
}
