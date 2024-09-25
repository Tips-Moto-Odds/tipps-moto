<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\AccountsTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    /**Guest Routes
     ********************************
     */
    //get to dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Manage Profile
    Route::get('/ManageProfile', [ProfileController::class, 'index'])->name('ManageProfile');
    //Profile Actions
    include_once "UserRoutes/index.php";


    //Manage Tips
    Route::get('/ManageTips', [TipsController::class, 'index'])->name('ManageTips');
    include_once "UserRoutes/index.php";

    //Manage Transactions
    Route::get('/ManageTransactions', [TransactionController::class, 'index'])->name('ManageTransactions');


    /**Manager Routes
     *******************************
     */
    //Manage users
    Route::get('/ManageAccounts', [UserAccountsController::class, "index"])->name('ManageAccounts');

    //Manage Football Teams
    Route::get('/ManageFootballTeams', [FootballController::class, 'index'])->name('ManageFootballTeams');


    /**Manager Routes
     *******************************
     */
    //Manage Account Types
    Route::get('/ManageAccountTypes', [AccountsTypeController::class, 'index'])->name('ManageAccountTypes');
});
