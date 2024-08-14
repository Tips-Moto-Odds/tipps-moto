<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\SubscriptionController;
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

    Route::post('/app/subscribe', [SubscriptionController::class,'subscribe'])->name('subscribe');

    Route::post('/app/unsubscribe', [SubscriptionController::class,'unsubscribe'])->name('unsubscribe');


});

