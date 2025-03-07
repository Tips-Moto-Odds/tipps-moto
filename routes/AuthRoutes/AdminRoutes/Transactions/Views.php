<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/Transactions', [TransactionController::class, 'index'])->name('listTransactions');


