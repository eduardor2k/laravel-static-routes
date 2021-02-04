<?php

namespace Eduardor2k\LaravelStaticRoutes;

use Illuminate\Support\ServiceProvider;

class LaravelStaticRoutesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravelstaticroutes.php' => config_path('laravelstaticroutes.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelstaticroutes.php', 'laravelstaticroutes');

        $this->commands([
            \Eduardor2k\LaravelStaticRoutes\Commands\StaticRoutesApache2Command::class
        ]);
    }
}