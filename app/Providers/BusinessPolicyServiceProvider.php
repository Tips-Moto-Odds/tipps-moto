<?php

namespace App\Providers;

use App\Service\BusinessPolicyService;
use Illuminate\Support\ServiceProvider;

class BusinessPolicyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('business-policy', function ($app) {
            return new BusinessPolicyService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
