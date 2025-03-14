<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommmentsController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Egulias\EmailValidator\Result\Reason\CommentsInIDRight;
use Faker\Guesser\Name;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('index');
//     // return view('auth.register');
// });
Route::get('/', HomeController::class)->name('home');

Route::get('create-account', [RegisterController::class, 'index'])->name('create-account');
Route::post('create-account-submit', [RegisterController::class, 'store'])->name('create-account-submit');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

// Rutas para perfil
Route::get('{user:username}/profile-edit', [ProfileController::class, 'index'])->name('profile.index');
Route::post('{user:username}/profile-edit', [ProfileController::class, 'store'])->name('profile.store');

// Route::get('muro', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
// Route::get('{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('{user:username}/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('{user:username}/post/{post}', [CommmentsController::class, 'store'])->name('comments.store');

Route::post('images', [ImageController::class, 'store'])->name('images.store');

// Like a fotos
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::get('{user:username}', [PostController::class, 'index'])->name('posts.index');


// Siguiendo...
Route::post('{user:username}/follow', [FollowerController::class, 'store'])->name('user.follow');
Route::delete('{user:username}/follow', [FollowerController::class, 'destroy'])->name('user.unfollow');