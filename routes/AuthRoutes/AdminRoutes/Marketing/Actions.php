<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MarketingController;

    Route::get('/Marketing/data/Export', [MarketingController::class, 'export'])->name('export');


