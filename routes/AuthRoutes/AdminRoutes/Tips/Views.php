<?php

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TipsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Route::get('/', [TipsController::class, 'index'])->name('listTips');
Route::get('/create', [TipsController::class, 'create'])->name('createTips');
