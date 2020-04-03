<?php

namespace Marshmallow\GoogleAdsLeadExtention\App\Http;

use App\GoogleAdsLeadExtention;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Marshmallow\GoogleAdsLeadExtention\App\Rules\GoogleKeyRule;
use Validator;

class GoogleAdsLeadExtentionController extends Controller
{
	public function index (Request $request)
	{
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

        $extention = new GoogleAdsLeadExtention($request);
        $extention->handle();
        $extention->notify();

		return [];
	}
}