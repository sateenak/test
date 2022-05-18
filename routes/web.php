<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('chat', function () {
    return view('chat', [
        'title' => 'chat',
        'posts' => Post::where('user_id', auth()->User()->id)->latest()->get(),
        'user' => auth()->User()->id,
        'count' => Post::where('user_id', auth()->User()->id)->get()
    ]);
});
Route::resource('/post', PostController::class)->middleware('auth');
Route::resource('/', PostController::class)->middleware('auth');
Route::get('/feed', [PostController::class, 'index'])->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::post('/profile/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
Route::get('/form-login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/form-login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/form-register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/form-register', [RegisterController::class, 'store']);
Route::get('/trending', function () {
    return view('trending', [
        'title' => 'trending',
        'posts' => Post::where('user_id', auth()->User()->id)->latest()->get(),
        'user' => auth()->User()->id,
        'count' => Post::where('user_id', auth()->User()->id)->get()
    ]);
});
Route::get('/explore', function () {
    return view('explore', [
        'title' => 'explore',
        'posts' => Post::where('user_id', auth()->User()->id)->latest()->get(),
        'user' => auth()->User()->id,
        'count' => Post::where('user_id', auth()->User()->id)->get()
    ]);
});
Route::post('/feed/like', [LikeController::class, 'store'])->name('like.add');
Route::post('/feed/comment', [CommentController::class, 'store'])->name('comment.add');
Route::get('/home', [PostController::class, 'index'])->middleware('auth');
