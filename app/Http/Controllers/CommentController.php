<?php

namespace App\Http\Controllers;

use Core\Comment\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function save(Request $req)
    {
        $comment = new Comment(
            (int)$req->id,
            $req->movieId,
            $req->userId,
            $req->comment,
            $req->creationDate
        );

        dd($comment);
    }
}
