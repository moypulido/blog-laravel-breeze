<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->available_comments < 1) {
            return redirect()->back()->with('error', 'No tienes comentarios disponibles.');
        }

        // dd($request->all());
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:1000',
        ]);

        $this->commentService->create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        $user->available_comments -= 1;
        $user->save();

        return redirect()->back()->with('success', 'Comentario agregado');
    }

    public function destroy($id)
    {
        $this->commentService->delete($id);
        return redirect()->back()->with('success', 'Comentario eliminado');
    }

    public function getAll()
    {
        return $this->commentService->getAll();
    }
}
