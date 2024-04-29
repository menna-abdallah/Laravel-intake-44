<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class,'index'])->name('post.home');
Route::get('/posts/{id}', [PostController::class,'show'])->name('post.show')->where('id', '[0-9]+');
Route::get('/posts/{id}/edit', [PostController::class,'edit'])->name('post.edit')->where('id', '[0-9]+');
Route::get('/posts/create', [PostController::class,'create'])->name('post.create');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
