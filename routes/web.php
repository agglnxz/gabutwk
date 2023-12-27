<?php

use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostinganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/feed', [HomeController::class, 'feed'])->name('feed');
    Route::resource('/postingan', PostinganController::class);
    Route::post('/like-postingan/{id}', [LikesController::class, 'LikePostingan'])->name('like.postingan');
    Route::post('/like-komentar-postingan/{postingan_id}/{comment_id}', [LikesController::class, 'LikeCommentPostingan'])->name('like.comment.postingan');
    Route::post('/beri-komentar/{id}', [CommentsController::class, 'StoreCommentPostingan'])->name('store.comment.postingan');
});

