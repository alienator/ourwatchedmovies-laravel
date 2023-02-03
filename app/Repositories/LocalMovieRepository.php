<?php

namespace App\Repositories;

use Core\Movie\Movie as Entity;
use Core\Movie\MovieLocalRepository;

use App\Models\Movie;

class LocalMovieRepository implements MovieLocalRepository
{
    public function find(string $criteria) {
        // TODO: return a movei entity
        return Movie::where('title', 'LIKE', '%' . $criteria . '%')->get();
    }
    
    public function findById(string $id) {}
    public function save(Entity $movie) {}
    public function getLastInsertedId(): int {return 0;}
}
