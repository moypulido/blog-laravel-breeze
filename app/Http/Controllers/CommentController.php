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
        $this->commentService->create($request->all());
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
