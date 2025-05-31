<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function create(array $data): Post
    {
        return Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);
    }

    public function delete(int $id): bool
    {
        $post = Post::find($id);
        if ($post) {
            return $post->delete();
        }
        return false;
    }
    public function getAll()
    {
        return Post::all();
    }
    public function find(int $id): Post|null
    {
        $post = Post::find($id);
        return $post;
    }

    public function addHeart(int $postId): void
    {
        $post = Post::find($postId);
        if ($post) {
            $post->hearts += 10;
            $post->save();
        }
    }
    public function getUserByPostId(int $postId)
    {
        $post = Post::find($postId);
        return $post ? $post->user : null;
    }
}
