<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Dashboard
include_once 'Dashboard/index.php';

//Manage
include_once 'Accounts/index.php';
include_once 'Matches/index.php';
include_once 'Transactions/index.php';
//    include_once 'Football/index.php';
include_once 'Tips/index.php';
include_once 'Selection/index.php';

//Administration
include_once 'AccountTypes/index.php';
//    include_once 'Teams/index.php';

//Account
include_once 'Profile/index.php';







