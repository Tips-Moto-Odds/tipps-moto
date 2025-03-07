<?php

use App\Http\Controllers\SelectionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SelectionController::class, 'index'])->name('listSelections');
Route::get('/create', [SelectionController::class, 'create'])->name('createSelections');
Route::get('/view/{selection}', [SelectionController::class, 'view'])->name('viewSelections');
