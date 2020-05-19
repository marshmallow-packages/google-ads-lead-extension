<?php

namespace Marshmallow\GoogleAdsLeadExtension\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class InstallCommand extends Command {
	protected $generated_key = null;
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'googleads:install-lead-extension';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install the nessasery files for lead extension handling.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$this->publishConfig();
		$this->publishClassStub();
		$this->generateAndStoreKey();

		$this->info('Use the details below for your "Lead delivery options" in Google Ads.');
		$this->info('Webhook URL: ' . route('GoogleAdsLeadExtensionController@index'));
		$this->info('Key: ' . $this->generated_key);
	}

	protected function publishConfig() {
		Artisan::call('vendor:publish', [
			'--provider' => 'Marshmallow\\GoogleAdsLeadExtension\\GoogleAdsLeadExtensionServiceProvider',
			'--force' => true,
		]);
	}

	protected function generateAndStoreKey() {
		if (env('GOOGLE_ADS_LEAD_EXTENTION_KEY')) {
			$this->generated_key = env('GOOGLE_ADS_LEAD_EXTENTION_KEY');
			if (!$this->confirm('Key is already generated. Do you wish to generate a new one?')) {
				return;
			}
		}

		$this->generated_key = Str::random(32);
		$exitCode = Artisan::call("env:set GOOGLE_ADS_LEAD_EXTENTION_KEY " . $this->generated_key);

	}

	protected function publishClassStub() {
		if (file_exists($this->getClassLocation())) {
			if (!$this->confirm('GoogleAdsLeadExtension already exists, do you wish to override?')) {
				return;
			}
		}
		file_put_contents($this->getClassLocation(), $this->getClassStub());
	}

	protected function getClassLocation() {
		return app_path() . '/GoogleAdsLeadExtension.php';
	}

	protected function getClassStub() {
		return file_get_contents(__dir__ . '/../../../resources/stubs/GoogleAdsLeadExtension.stub');
	}
}
