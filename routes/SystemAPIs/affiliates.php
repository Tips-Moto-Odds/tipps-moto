<?php

use App\Http\Controllers\AffiliateController;
use Illuminate\Support\Facades\Route;


Route::resource('/affiliates', AffiliateController::class)->only(['store', 'update', 'destroy']);
Route::post('/affiliates/add-user', [AffiliateController::class, 'add_user']);
Route::post('/affiliates/add-purchase', [AffiliateController::class, 'add_purchase']);
