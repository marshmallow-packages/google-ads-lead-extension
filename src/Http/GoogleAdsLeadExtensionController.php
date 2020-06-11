<?php

namespace Marshmallow\GoogleAdsLeadExtension\Http;

use Validator;
use Monolog\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Marshmallow\GoogleAdsLeadExtension\Rules\GoogleKeyRule;

class GoogleAdsLeadExtensionController extends Controller
{
	public function index(Request $request)
	{
		/**
		 * Log the request first if this is activated in the
		 * config file.
		 */
		if (config('google-ads-lead-extension.logging')) {
			Log::debug('GoogleAdsLeadExtensionController', $request->all());
		}

		$validator = Validator::make($request->all(), [
			'lead_id' => [
				'required', 'string'
			],
			'api_version' => [
				'required', 'string'
			],
			'form_id' => [
				'required', 'int'
			],
			'campaign_id' => [
				'required', 'int'
			],
			'google_key' => [
				'required', 'string', new GoogleKeyRule
			],
		]);

		if ($validator->fails()) {
			return $validator->errors();
		}

		$handler = config('google-ads-lead-extension.handler');
		$extension = new $handler($request);
		$extension->handle();
		$extension->notify();

		return [];
	}
}
