<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Core\Comment\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentRepository $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function save(Request $req, $id = 0)
    {
        $comment = new Comment(
            $id,
            $req->movieId,
            $req->userId,
            $req->comment,
            $req->creationDate
        );

        $this->commentRepository->save($comment);

        return ['true'];
    }

    public function findByMovieId(Request $req)
    {
        $movieId = $req->movieId;

        $this->commentRepository->findByMovieId($movieId);
    }
}
