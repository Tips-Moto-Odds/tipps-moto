<?php

use App\Http\Controllers\FootballController;
use App\Http\Controllers\MatchesController;
use Illuminate\Support\Facades\Route;

Route::get('/{match}/update', [MatchesController::class, 'update'])->name('updateMatch');
Route::get('/create', [MatchesController::class, 'create'])->name('createMatch');
Route::get('/{match}', [MatchesController::class, 'view'])->name('viewMatch');
Route::get('/', [MatchesController::class, 'index'])->name('listMatches');







