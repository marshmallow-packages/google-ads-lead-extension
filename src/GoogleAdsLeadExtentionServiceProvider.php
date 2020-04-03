<?php

namespace Marshmallow\GoogleAdsLeadExtention;

use Illuminate\Support\ServiceProvider;

class GoogleAdsLeadExtentionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Marshmallow\GoogleAdsLeadExtention\App\Http\GoogleAdsLeadExtentionController');
        
        /**
         * Merge in the config
         */
        $this->mergeConfigFrom(
            __DIR__.'/config/google-ads-lead-extention.php', 'google-ads-lead-extention'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Config
         */
        $this->publishes([
            __DIR__.'/config/google-ads-lead-extention.php' => config_path('google-ads-lead-extention.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/resources/views', 'google-ads-lead-extention');

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        /**
         * Commands
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Marshmallow\GoogleAdsLeadExtention\App\Console\Commands\InstallCommand::class,
            ]);
        }
    }
}
