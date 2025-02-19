<?php

namespace App\Providers;

use App\Jobs\OnitSTKPush;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Debugbar', Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(199);

//        $this->app->bindMethod([OnitSTKPush::class, 'handle'], function (OnitSTKPush $job, Application $app) {
//            return $job->handle($app->make(PaymentProcessor::class));
//        });
    }
}
