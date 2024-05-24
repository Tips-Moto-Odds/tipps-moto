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
    Route::get('/AccountTypes', [AccountsTypeController::class,'index'])->name('ListAccountTypes');

    //create account page view
    Route::get('/AccountTypes/create', fn (Request $request) => Inertia::render($folder.'/AccountType'))->name('CreateAccountType');

    //get account by id view
    Route::get('/AccountTypes/{id}', [AccountsTypeController::class,'view'])->name('ViewAccountByIDs');

    //patch an accountTypes
    Route::patch('/patchAccount/{id}', [AccountsTypeController::class,'patch'])->name('patchAccount');

    //post an accountTypes
    Route::post('/postAccount', [AccountsTypeController::class,'post'])->name('postAccount');

    //delete account type
    Route::delete('/deleteAccountType/{team}', [AccountsTypeController::class,'delete'])->name('deleteAccountType');

    //search user by username
    Route::post('/searchUserByUsername', [AccountsTypeController::class,'searchUser'])->name('searchUserByUsername');

    //assign Role
    Route::post('/assignRole/{team}/{user}', [AccountsTypeController::class,'assignRole'])->name('assignRole');

});

