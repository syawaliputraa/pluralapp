<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeLineController;
use App\Http\Controllers\Tweet\TweetDeleteController;
use App\Http\Controllers\Tweet\TweetEditController;
use App\Http\Controllers\Tweet\TweetStoreController;
use App\Http\Controllers\Tweet\TweetUpdateController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/timeline', TimeLineController::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::post('Tweets', TweetStoreController::class)->name('tweets.store');
Route::get('Tweets/{id}/edit', TweetEditController::class)->name('tweets.edit');
Route::put('Tweets/{id}', TweetUpdateController::class)->name('tweets.update');
Route::delete('Tweets/{id}', TweetDeleteController::class)->name('tweets.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
