<?php
namespace Eduardor2k\LaravelStaticRoutes;

class LaravelStaticRoutesProvider
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
            \Ed\MyCommand::class
        ]);
    }
}