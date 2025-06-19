<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users/{user}', fn(Request $request, User $user) => $user)->middleware('auth:sanctum');

