<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

$folder = 'Administration/Administration';

//list account types view
Route::get('/ListAccountTypes', [AccountsTypeController::class, 'index'])->name('ListAccountTypes');

//create account page view
Route::get('/AccountTypes/create', fn(Request $request) => Inertia::render($folder . '/AccountType'))->name('CreateAccountType');

//get account by id view
Route::get('/AccountTypes/{id}', [AccountsTypeController::class, 'view'])->name('ViewAccountByIDs');




