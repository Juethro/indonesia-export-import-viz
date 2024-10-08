<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\query_handler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/data/chart_5', [query_handler::class, 'totalDataControl'])->middleware(['auth', 'verified']);
Route::post('/data/chart_7', [query_handler::class, 'comparisonDataControl'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/data/scoreboard', [ChartController::class, 'getScoreboardData'])->middleware(['auth', 'verified']);
use App\Http\Controllers\ScoreboardController;

require __DIR__.'/auth.php';
