<?php

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use App\Models\User;


// Route::get('/posts', [PostController::class,'index'])
//     ->name('posts.index');

// Route::post('/posts', [PostController::class,'store'])
//     ->name('posts.store');

// Route::get('/posts/create', [PostController::class,'create'])
//     ->name('posts.create');

// Route::get('/posts/{id}', [PostController::class,'show'])
//     ->name('posts.show');

// Route::get('/posts/{id}/edit', [PostController::class,'edit'])
//     ->name('posts.edit');

// Route::put('/posts/{id}', [PostController::class,'update'])
//     ->name('posts.update');

// Route::delete('/posts/{id}', [PostController::class,'destroy'])
//     ->name('posts.destroy');

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);
Route::post('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);




Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');


Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if (!$user) {
        $user = User::where('email', $githubUser->email)->first();
    }

    if (!$user) {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'password' => bcrypt($githubUser->token)
        ]);
    } else {
        $user->update([
            'name' => $githubUser->name,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect('/posts');
});
