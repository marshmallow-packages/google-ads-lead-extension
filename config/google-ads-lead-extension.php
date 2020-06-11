<?php

return [

	/**
	 * Prefix for the url that you will also by whitelisting in
	 * your VerifyCsrfToken.php.
	 */
	'prefix' => 'google-ads',


	/**
	 * Emailaddress where new leads will be mailed to.
	 */
	'conversion-email-address' => '',


	/**
	 * Private key to make sure the request are coming
	 * from Google. This key will be added to you Google Ads Extension
	 */
	'key' => env('GOOGLE_ADS_LEAD_EXTENTION_KEY', 'DUMMY_KEY'),


	/**
	 * The class that will handle the webhook data. This class should extend
	 * Marshmallow\GoogleAdsLeadExtension\GoogleAdsLeadExtensionBase to work.
	 */
	'handler' => \App\GoogleAdsLeadExtension::class,


	/**
	 * Log all the request to a log file.
	 */
	'logging' => true,

];
