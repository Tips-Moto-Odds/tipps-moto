<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //get to dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    //Profile
    Route::get('/account', function () {
        return Inertia::render('Dashboard');
    })->name('account');

    Route::get('/settings', function () {
        return Inertia::render('Dashboard');
    })->name('settings');

    //Manage
    Route::get('/accounts', function () {
        $users = App\Models\User::all();

        $users->map(function ($userItem) {
            try {

                $userItem->DateJoined = [
                    'time' => ($userItem->created_at)->format('h:i A'),
                    'date' => ($userItem->created_at)->format('F j, Y'),
                ];

                $result = collect(DB::select('SELECT * FROM sessions WHERE user_id = ? Limit 1', [$userItem->id]))->last();

                $userItem->activity = [
                    'date' => date('F j, Y ', $result->last_activity),
                    'time' => date('g:i A', $result->last_activity),
                ];
            }catch (\Exception $e){

            }
        });

        return Inertia::render('Administration/Manage/Accounts/Index',[
            'users' => $users,
            'stats' => [
                'total' => $users->count(),
            ]
        ]);

    })->name('manage.accounts');

    Route::get('/tips', function () {
        return Inertia::render('Dashboard');
    })->name('tips');

    Route::get('/transactions', function () {
        return Inertia::render('Dashboard');
    })->name('transactions');

    Route::get('/notifications', function () {
        return Inertia::render('Dashboard');
    })->name('notifications');

    //Administration
    Route::get('/model', function () {
        return Inertia::render('Dashboard');
    })->name('model');

    Route::get('/system', function () {
        return Inertia::render('Dashboard');
    })->name('system');


    include_once "AccountTypes.php";
    include_once "Profile_Account.php";
    include_once "Tips.php";
    include_once "Football/index.php";

});







