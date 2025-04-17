<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MarketingController;

    Route::get('/', [MarketingController::class, 'index'])->name('listMarketing');
    Route::get('/{id}', [MarketingController::class, 'view'])->name('viewMarketing');
