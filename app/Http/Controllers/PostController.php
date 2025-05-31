<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

use App\Http\Controllers\ProfileController;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->postService->create($validated);
        return redirect()->route('dashboard')->with('success', 'Publicación creada correctamente');
    }

    public function destroy($id)
    {
        $this->postService->delete($id);
        return redirect()->back()->with('success', 'Publicación eliminada correctamente');
    }

    public function heart(Request $request, $postId)
    {
        $post = $this->postService->addHeart($postId);

        $post_user = $this->postService->getUserByPostId($postId);
        ProfileController::addHearts($post_user);

        if ($request->expectsJson()) {
            return response()->json(['hearts' => $post ? $post->hearts : 0]);
        }

        return redirect()->back()->with('success', 'Me gusta actualizado correctamente');
    }
}
