<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    include_once "AdminRoutes/index.php";
    include_once "CustomerRoutes/index.php";
});

