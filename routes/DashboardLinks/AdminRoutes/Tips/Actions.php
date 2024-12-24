<?php
use App\Http\Controllers\TipsController;
use Illuminate\Support\Facades\Route;
//search user by username action
//assign Role Action

//post account action
Route::post('/', [TipsController::class, 'store'])->name('storeTip');

//patch account action


Route::patch('/{tip}', [TipsController::class, 'update'])->name('patchTip');

//delete account action
Route::delete('/{tip}', [TipsController::class, 'delete'])->name('deleteTips');


