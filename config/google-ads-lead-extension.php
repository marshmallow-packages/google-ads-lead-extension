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
	 * The class that will handle the webhook data. This class should extend
	 * Marshmallow\GoogleAdsLeadExtension\GoogleAdsLeadExtensionBase to work.
	 */
	'handler' => \App\GoogleAdsLeadExtension::class,


	/**
	 * Log all the request to a log file.
	 */
	'logging' => true,

];
