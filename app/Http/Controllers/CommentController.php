<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Core\Comment\Comment;
use Core\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct()
    {
        $this->commentService = new CommentService(new CommentRepository);
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

        $this->commentService->save($comment);

        return ['true'];
    }

    public function findByMovieId(Request $req)
    {
        $movieId = $req->movieId;

        $ret = array();
        $comments = $this->commentService->findByMovieId($movieId);       
        foreach($comments as $comment) {
            $ret[] = [
                'id' => $comment->getId(),
                'movieId' => $comment->getMovieId(),
                'userId' => $comment->getUserId(),
                'comment' => $comment->getComment(),
                'creationDate' => $comment->getCreationDate()
            ];
        }

        return $ret;
    }

    public function findById($id)
    {
        $comment = $this->commentService->findById($id);

        $ret = array();
        if ($comment->getId() > 0) {
            $ret = [
                'id' => $comment->getId(),
                'movieId' => $comment->getMovieId(),
                'userId' => $comment->getUserId(),
                'comment' => $comment->getComment(),
                'creationDate' => $comment->getCreationDate(),
            ];
        }

        return $ret;
    }
}
