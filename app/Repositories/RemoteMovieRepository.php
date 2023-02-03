<?php

namespace App\Repositories;

use Core\Movie\Movie as Entity;
use Core\Movie\MovieRemoteRepository;

class RemoteMovieRepository implements MovieRemoteRepository
{
    public function find(string $criteria) {}
    public function findById(string $id) {}
    public function save(Entity $movie) {}
    public function getLastInsertedId(): int {return 0;}
}
