<?php

namespace App\Http\Controllers;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function like(string $type, int $id)
    {
        // Convertir el tipo a nombre de modelo
        $modelClass = match ($type) {
            'post' => \App\Models\Post::class,
            'comment' => \App\Models\Comment::class,
            default => abort(404),
        };
    
        $likeable = $modelClass::findOrFail($id);
    
        $this->likeService->toggle($likeable);
    
        return redirect()->back();
    }
}
