<?php

namespace App\Http\Controllers;

use App\Repositories\LocalMovieRepository;
use App\Repositories\RemoteMovieRepository;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function find(Request $req)
    {
        $local = new LocalMovieRepository();
        $remote = new RemoteMovieRepository();
        $movieService = new \Core\Movie\MovieService($local, $remote);
        
        return $movieService->findLocal($req->criteria);
    }
}
