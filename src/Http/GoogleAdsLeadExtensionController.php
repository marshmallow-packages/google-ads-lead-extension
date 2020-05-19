<?php

namespace Marshmallow\GoogleAdsLeadExtension\Http;

use App\GoogleAdsLeadExtension;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Marshmallow\GoogleAdsLeadExtension\Rules\GoogleKeyRule;
use Validator;

class GoogleAdsLeadExtensionController extends Controller {
	public function index(Request $request) {
		$validator = Validator::make($request->all(), [
			'lead_id' => ['required', 'string'],
			'api_version' => ['required', 'string'],
			'form_id' => ['required', 'int'],
			'campaign_id' => ['required', 'int'],
			'google_key' => ['required', 'string', new GoogleKeyRule],
		]);

		if ($validator->fails()) {
			return $validator->errors();
		}

		$extension = new GoogleAdsLeadExtension($request);
		$extension->handle();
		$extension->notify();

		return [];
	}
}
