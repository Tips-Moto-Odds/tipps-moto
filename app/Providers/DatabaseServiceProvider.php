<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);


        // Add paths to the migrations subfolders
        $this->loadMigrationsFrom([
            database_path('migrations/System'),
            database_path('migrations/Users'),
            database_path('migrations/Matches'),
            database_path('migrations/Payments'),
            database_path('migrations/Adapters'),


//            -------------------------------------------
//            Unusable
//            database_path('migrations/Teams'),
//            database_path('migrations/Football'),
        ]);
    }
}
