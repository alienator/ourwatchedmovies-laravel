<?php

namespace App\Http\Controllers;

use App\Repositories\LocalMovieRepository;
use App\Repositories\RemoteMovieRepository;
use Core\Movie\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private LocalMovieRepository $local;
    private RemoteMovieRepository $remote;
    private MovieService $movieService;

    public function __construct()
    {
        $this->local = new LocalMovieRepository();
        $this->remote = new RemoteMovieRepository();
        $this->movieService = new MovieService($this->local, $this->remote);
    }
    
    public function find(Request $req): array
    {
        switch ($req->where) {
            case 'local':
                $results = $this->movieService->findLocal($req->criteria);
                break;
            case 'remote':
                $results = $this->movieService->findRemote($req->criteria);
                break;
            case 'all':
                $results = array_merge(
                    $this->movieService->findLocal($req->criteria),
                    $this->movieService->findRemote($req->criteria)
                );
                break;
        }

        $ret = array();
        foreach ($results as $item) {
            $ret[] =  [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'summary' => $item->getSummary(),
                'releaseDate' => $item->getReleaseDate(),
                'imagePath' => $item->getImagePath(),
                'globalScore' => $item->getGlobalSCore(),
                'moreInfo' => $item->getMoreInfo(),
                'watchedDate' => $item->getWatchedDate(),
                'ourScore' => $item->getOurScore()
            ];
        }

        return $ret;
    }

    public function details(Request $req): array
    {
        $res = $this->movieService->findById($req->id);
        return [
            'id' => $res->getId(),
            'title' => $res->getTitle(),
            'summary' => $res->getSummary(),
            'releaseDate' => $res->getReleaseDate(),
            'imagePath' => $res->getImagePath(),
            'globalScore' => $res->getGlobalSCore(),
            'moreInfo' => $res->getMoreInfo(),
            'watchedDate' => $res->getWatchedDate(),
            'ourScore' => $res->getOurScore()
        ];
    }
}
