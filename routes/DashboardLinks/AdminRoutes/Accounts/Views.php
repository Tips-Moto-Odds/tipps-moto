<?php

use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserAccountsController::class, 'index'])->name('listUsers');
Route::get('/{id}', [UserAccountsController::class, 'view'])->name('viewUsers');
