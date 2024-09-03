<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LyricsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/show/{slug}', [VideoController::class, 'show'])->name('videos.show');

Route::get('/lyrics', [LyricsController::class, 'index'])->name('lyrics.index');
Route::get('/lyrics/show/{slug}', [LyricsController::class, 'show'])->name('lyrics.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
