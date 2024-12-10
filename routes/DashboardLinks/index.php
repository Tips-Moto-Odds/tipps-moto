<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserAccountsController;
use App\Http\Controllers\AccountsTypeController;


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Manage users
    Route::prefix('dashboard')->as('dashboard.')->group(function () {

        Route::prefix('user')->as('user.')->group(function () {

            Route::get('/', [UserAccountsController::class, 'index'])->name('listUsers');
            Route::get('/{id}', [UserAccountsController::class, 'view'])->name('viewUsers');
            Route::delete('/{user}', [UserAccountsController::class, 'delete_user'])->name('deleteUsers');

        });

        Route::prefix('tips')->as('tips.')->group(function () {

            Route::get('/', [TipsController::class, 'index'])->name('listTips');
            Route::put('/{tip}', [TipsController::class, 'update'])->name('update');
            Route::delete('/{tip}', [TipsController::class, 'delete'])->name('delete');

        });

    });

    //Manage Admin Profile
    Route::get('/Manage/MyProfile', [ProfileController::class, 'index'])->name('ManagersProfile');

    //Manage Tips

    //Manage Transactions
    Route::get('/ManageTransactions', [TransactionController::class, 'index'])->name('ManageTransactions');


    //Manage Football Teams
    Route::get('/ManageFootballTeams', [FootballController::class, 'index'])->name('ManageFootballTeams');

    Route::get('/ManageAccountTypes', [AccountsTypeController::class, 'index'])->name('ManageAccountTypes');
});


//dashboard.tips.