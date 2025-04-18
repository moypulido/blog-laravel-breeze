<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create(array $data): Comment
    {
        return Comment::create([
            'content' => $data['content'],
            'post_id' => $data['post_id'],
            'user_id' => Auth::id(),
        ]);
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
