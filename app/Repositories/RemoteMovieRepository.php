<?php

/**
 * Remote Repository using OMDb API
 */

namespace App\Repositories;

use Core\Movie\Movie;
use Core\Movie\MovieRemoteRepository;

class RemoteMovieRepository implements MovieRemoteRepository
{
    private string $url = 'http://www.omdbapi.com/?apikey=';

    public function find(string $criteria): array
    {
        $this->url .=  env('OMDbAPIKey', 'TEST') . '&plot=short&';
        $ch = curl_init($this->url . 's=' . $criteria);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        $movies = array();
        $res    =  json_decode($response, true);
        foreach ($res['Search'] as $item) {
            $movies[] = new Movie(
                $item['imdbID'],
                $item['Title'],
                '',
                $item['Year'],
                $item['Poster'],
                0,
                '',
                '',
                0
            );
        }

        return $movies;
    }


    public function findById(string $id): Movie
    {
        $this->url .=  env('OMDbAPIKey', 'TEST') . '&plot=short&';
        $ch = curl_init($this->url . 'i=' . $id);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        $res    =  json_decode($response, true);
        $movie = new Movie(
            $res['imdbID'],
            $res['Title'],
            $res['Plot'],
            $res['Year'],
            $res['Poster'],
            (float)$res['Ratings'][0]['Value'],
            '',
            '',
            0
        );
        
        return $movie;
    }
}
