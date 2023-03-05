<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
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
        App::bind('helper', function () {
            return new \App\Helpers\Helper;
        });

        App::bind('config-helper', function () {
            return new \App\Helpers\ConfigHelper;
        });

        App::bind('response', function () {
            return new \App\Helpers\Response;
        });
    }
}
