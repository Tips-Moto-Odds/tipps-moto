<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/Manage/MyProfile', [ProfileController::class, 'index'])->name('ManagerProfile');
