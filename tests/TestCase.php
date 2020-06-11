<?php

namespace Marshmallow\GoogleAdsLeadExtension\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Marshmallow\GoogleAdsLeadExtension\GoogleAdsLeadExtensionServiceProvider;

class TestCase extends BaseTestCase
{
	public function setUp(): void
	{
		parent::setUp();
		// additional setup
	}

	protected function getPackageProviders($app)
	{
		return [
			GoogleAdsLeadExtensionServiceProvider::class,
		];
	}

	protected function getEnvironmentSetUp($app)
	{
		// perform environment setup
	}
}
