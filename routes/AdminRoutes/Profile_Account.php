<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified']
)->group(function () {
    $folder = 'Administration/Profile';

    //list account types view
    Route::get('/Profile', [ProfileController::class,'index'])->name('ViewProfile');


    //patch user
    Route::patch('/patchUser/{user}', [ProfileController::class,'patch'])->name('patchUser');

    //patch password
    Route::patch('/patchPassword/{user}', [ProfileController::class,'patchPassword'])->name('patchPassword');

});

