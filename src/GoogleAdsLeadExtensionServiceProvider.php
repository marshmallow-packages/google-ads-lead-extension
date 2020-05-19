<?php

namespace Marshmallow\GoogleAdsLeadExtension;

use Illuminate\Support\ServiceProvider;

class GoogleAdsLeadExtensionServiceProvider extends ServiceProvider {
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->make('Marshmallow\GoogleAdsLeadExtension\Http\GoogleAdsLeadExtensionController');

		/**
		 * Merge in the config
		 */
		$this->mergeConfigFrom(
			__DIR__ . '/../config/google-ads-lead-extension.php', 'google-ads-lead-extension'
		);
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		/**
		 * Config
		 */
		$this->publishes([
			__DIR__ . '/config/google-ads-lead-extension.php' => config_path('google-ads-lead-extension.php'),
		]);

		$this->loadViewsFrom(__DIR__ . '/resources/views', 'google-ads-lead-extension');

		/**
		 * Routes
		 */
		$this->loadRoutesFrom(__DIR__ . '/routes.php');

		/**
		 * Commands
		 */
		if ($this->app->runningInConsole()) {
			$this->commands([
				\Marshmallow\GoogleAdsLeadExtension\Console\Commands\InstallCommand::class,
			]);
		}
	}
}
