<?php
use App\Http\Controllers\MatchesController;
use Illuminate\Support\Facades\Route;

//post account action
Route::post('/{match}', [MatchesController::class, 'post'])->name('addMatch');

//patch account action
Route::patch('/{match}/patch', [MatchesController::class, 'patch'])->name('patchMatch');

//delete account action
Route::delete('/{match}', [MatchesController::class, 'delete'])->name('deleteMatch');

