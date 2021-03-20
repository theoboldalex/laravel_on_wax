<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// AUTH
Route::group(['prefix' => '/auth'], function() {
  Route::get('/register', [RegisterController::class, 'index'])->name('register');
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/register', [RegisterController::class, 'store']);
  Route::post('/login', [LoginController::class, 'store']);
  Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
});

// USERS
Route::group(['prefix' => '/users'], function() {
  Route::get('/{username}/create', [RecordController::class, 'index'])->name('create')->middleware(['auth']);
  Route::post('/{username}/create', [RecordController::class, 'store'])->middleware(['auth']);
  Route::get('/{username}', [ProfileController::class, 'index'])->name('profile');
  Route::get('/{username}/edit', [ProfileController::class, 'show'])->name('edit_profile')->middleware(['auth']);
});

// RECORDS
Route::group(['prefix' => '/records'], function() {
  Route::get('/{id}', [RecordController::class, 'show'])->name('record_detail');
});
