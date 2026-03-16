<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force HTTPS is correct if you are in a production environment
         URL::forceScheme('https');

        // Change from useBootstrapFive() to useBootstrap() 
        // to fix the "Undefined Method" error
        Paginator::useBootstrap();
    }
}