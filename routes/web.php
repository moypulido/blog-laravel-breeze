<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $posts = Post::All();
    return view('dashboard' , compact('posts'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    // Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    // Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/like/{type}/{id}', [LikeController::class, 'like'])->name('like.toggle');

});

require __DIR__.'/auth.php';
