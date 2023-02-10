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

    public function findByMovieId(string $movieId): array
    {
        $model = Comment::where('movieId', $movieId)->get();

        $comments = array();
        foreach ($model as $item) {
            $comments[] = new Entity(
                $item->id,
                $item->movieId,
                $item->userId,
                $item->comment,
                $item->creationDate
            );
        }

        return $comments;
    }

    public function findById(int $id): Entity
    {
        $ret = new Entity(0, 0, 0, '', '');
        $model = Comment::where('id', $id)->first();
        if ($model) {
            $ret->setId($model->id);
            $ret->setMovieId($model->movieId);
            $ret->setUserId($model->userId);
            $ret->setComment($model->comment);
            $ret->setCreationDate($model->creationDate);
        }

        return $ret;
    }
}
