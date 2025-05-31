<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::All();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users_admin', function () {
    if (Auth::user()->role->name !== 'admin') {
        abort(403, 'No autorizado');
    }
    $users = User::all();
    $roles = Role::all();
    return view('users_admin', compact('users', 'roles'));
})->middleware(['auth', 'verified'])->name('users_admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('user.delete');
    Route::patch('/users/{user}/role', [ProfileController::class, 'updateRole'])->name('user.updateRole');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/heart/{post}', [PostController::class, 'heart'])->name('heart.add');

    Route::post('/posts/comments', [CommentController::class, 'store'])->name('comment.store');
});

require __DIR__ . '/auth.php';
