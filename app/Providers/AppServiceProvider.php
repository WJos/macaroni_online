<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            //UrlGenerator::forceScheme('https');
        }
        //
    }
}