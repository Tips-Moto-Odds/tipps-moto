<?php

use App\Http\Middleware\CheckUserId;
use Illuminate\Support\Facades\Route;

//Dashboard
include_once 'Dashboard/index.php';

Route::middleware([CheckUserId::class.':2'])->group(function () {

    //Manage
    include_once 'Accounts/index.php';
    include_once 'Matches/index.php';
    include_once 'Tips/index.php';
    include_once 'Selection/index.php';

    include_once 'System/index.php';
    include_once 'Transactions/index.php';
    include_once 'AccountTypes/index.php';

    //Account
    include_once 'Profile/index.php';

});






