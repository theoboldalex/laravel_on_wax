<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// AUTH
Route::group(['prefix' => '/auth'], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
});

// USERS
Route::group(['prefix' => '/users'], function () {
    Route::get('/{username}/create', [RecordController::class, 'index'])->name('create')->middleware(['auth']);
    Route::post('/{username}/create', [RecordController::class, 'store'])->middleware(['auth']);
    Route::get('/{username}', [ProfileController::class, 'index'])->name('profile');
    Route::get('/{username}/edit', [ProfileController::class, 'show'])->name('edit_profile')->middleware(['auth']);
    Route::post('/{username}/edit', [ProfileController::class, 'store'])->middleware(['auth']);
    Route::post('/{username}/follow', [FollowController::class, 'follow'])->name('follow')->middleware(['auth']);
    Route::post('/{username}/unfollow', [FollowController::class, 'unfollow'])->name('unfollow')->middleware(['auth']);
    Route::get('/{username}/followers', [FollowController::class, 'followers'])->name('followers');
    Route::get('/{username}/following', [FollowController::class, 'following'])->name('following');
});

// RECORDS
Route::group(['prefix' => '/records'], function () {
    Route::get('/{id}', [RecordController::class, 'show'])->name('record_detail');
    Route::post('/{id}/like', [LikesController::class, 'like'])->name('like');
    Route::post('/{id}/unlike', [LikesController::class, 'unlike'])->name('unlike');
    Route::post('/{id}/comment', [CommentController::class, 'store'])->name('comment');
});
