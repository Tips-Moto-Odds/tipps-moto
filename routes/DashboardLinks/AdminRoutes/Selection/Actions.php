<?php

use App\Http\Controllers\SelectionController;
use App\Http\Controllers\TipsController;
use Illuminate\Support\Facades\Route;

Route::post('/', [SelectionController::class, 'store'])->name('storeSelection');

Route::patch('/{selection}', [SelectionController::class, 'update'])->name('updateSelection');

Route::delete('/{selection}', [SelectionController::class, 'delete'])->name('deleteSelection');


