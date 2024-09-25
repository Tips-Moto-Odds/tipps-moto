<?php

use App\Http\Controllers\AccountsTypeController;
use Illuminate\Support\Facades\Route;


//post an accountTypes
Route::post('/postAccount', [AccountsTypeController::class, 'post'])->name('postAccount');

//patch an accountTypes
Route::patch('/patchAccount/{id}', [AccountsTypeController::class, 'patch'])->name('patchAccount');

//delete account type
Route::delete('/deleteAccountType/{team}', [AccountsTypeController::class, 'delete'])->name('deleteAccountType');

//search user by username
Route::post('/searchUserByUsername', [AccountsTypeController::class, 'searchUser'])->name('searchUserByUsername');

//assign Role
Route::post('/assignRole/{team}/{user}', [AccountsTypeController::class, 'assignRole'])->name('assignRole');


