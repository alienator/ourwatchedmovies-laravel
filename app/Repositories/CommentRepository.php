<?php

namespace App\Repositories;

use App\Models\Comment;
use Core\Comment\CommentRepository as CommentCommentRepository;
use Core\Comment\Comment as Entity;

class CommentRepository implements CommentCommentRepository
{
    public function save(Entity $comment): void
    {
        $model = new Comment();
        $model->userId = $comment->getUserId();
        $model->movieId = $comment->getMovieId();
        $model->comment = $comment->getComment();
        $model->creationDate = $comment->getCreationDate();

        $model->save();
    }
}
