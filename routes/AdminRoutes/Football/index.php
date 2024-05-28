<?php

use App\Http\Controllers\FootballController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {

    Route::get('/Football', [FootballController::class,'index'])->name('football');

});







