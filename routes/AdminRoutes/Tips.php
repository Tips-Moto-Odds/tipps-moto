<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\TipsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified']
)->group(function () {
    $folder = 'Administration/Administration';

    Route::get('/tips', [TipsController::class,'index'])->name('listTips');

    Route::get('/tips/{tip}', [TipsController::class,'view'])->name('viewTip');

});

