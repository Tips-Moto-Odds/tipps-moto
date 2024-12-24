<?php
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;

//search user by username action

//assign Role Action


//post account action

//patch account action

//delete account action
Route::delete('/{user}', [UserAccountsController::class, 'delete_user'])->name('deleteUsers');


