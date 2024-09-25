<?php

use App\Http\Controllers\TipsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified']
)->group(function () {

});

