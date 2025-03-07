<?php

use App\Http\Controllers\FootballController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {

    Route::post('/searchClub', [FootballController::class,'searchClub'])->name('searchClub');

    Route::post('/upsertClub', [FootballController::class,'upsertClub'])->name('upsertClub');

    Route::delete('/deleteClub/{club}', [FootballController::class,'deleteClub'])->name('deleteClub');

});







