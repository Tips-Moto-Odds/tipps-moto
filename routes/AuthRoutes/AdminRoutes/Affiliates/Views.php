<?php

use App\Http\Controllers\AffiliateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AffiliateController::class, 'index'])->name('listAffiliates');
Route::get('/{id}', [AffiliateController::class, 'view'])->name('viewAffiliate');
