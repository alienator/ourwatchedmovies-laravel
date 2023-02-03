<?php

namespace App\Http\Controllers;

use App\Repositories\LocalMovieRepository;
use App\Repositories\RemoteMovieRepository;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function find(Request $req): array
    {
        $local = new LocalMovieRepository();
        $remote = new RemoteMovieRepository();
        $movieService = new \Core\Movie\MovieService($local, $remote);

        switch ($req->where) {
            case 'local':
                $results = $movieService->findLocal($req->criteria);
                break;
            case 'remote':
                $results = $movieService->findRemote($req->criteria);
                break;
            case 'all':
                $results = array_merge(
                    $movieService->findLocal($req->criteria),
                    $movieService->findRemote($req->criteria)
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
}
