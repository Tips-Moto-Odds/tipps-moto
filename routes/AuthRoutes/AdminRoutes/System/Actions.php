<?php

use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;

Route::post('/syncData',[SystemController::class,'syncData'])->name('syncData');


