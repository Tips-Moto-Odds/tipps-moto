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





});

