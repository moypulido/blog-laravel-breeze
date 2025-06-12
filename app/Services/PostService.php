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
    public function find(int $id): ?Post
    {
        $post = Post::where('id', $id)->first();
        return $post instanceof Post ? $post : null;
    }

    public function addHeart(int $postId): Post|null
    {
        $post = Post::find($postId);
        if ($post instanceof Post) {
            $post->hearts += 10;
            $post->save();
            return $post;
        }
        return null;
    }
    public function getUserByPostId(int $postId)
    {
        $post = Post::find($postId);
        return $post ? $post->user : null;
    }
}
