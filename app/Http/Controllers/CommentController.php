<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Core\Comment\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function save(Request $req, $id = 0)
    {
        $comment = new Comment(
            $id,
            $req->movieId,
            $req->userId,
            $req->comment,
            $req->creationDate
        );

        $repo = new CommentRepository();
        $repo->save($comment);

        return ['true'];
    }
}
