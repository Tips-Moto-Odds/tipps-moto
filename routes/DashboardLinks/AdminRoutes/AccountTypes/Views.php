<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified']
)->group(function () {
    $folder = 'Administration/Administration';

    //list account types view

    //create account page view
    Route::get('/AccountTypes/create', fn (Request $request) => Inertia::render($folder.'/AccountType'))->name('CreateAccountType');

    //get account by id view
    Route::get('/AccountTypes/{id}', [AccountsTypeController::class,'view'])->name('ViewAccountByIDs');

});

