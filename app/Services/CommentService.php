<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }

    public function getAll()
    {
        return Comment::all();
    }
}
