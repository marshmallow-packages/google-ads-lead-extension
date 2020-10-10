<?php

namespace Marshmallow\GoogleAdsLeadExtension\Http;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Marshmallow\GoogleAdsLeadExtension\Http\Requests\GoogleLeadRequest;

class GoogleAdsLeadExtensionController extends Controller
{
    public function index(GoogleLeadRequest $request)
    {
        /**
         * Log the request first if this is activated in the
         * config file.
         */
        if (config('google-ads-lead-extension.logging')) {
            Log::debug('GoogleAdsLeadExtensionController', $request->all());
        }

        $handler = config('google-ads-lead-extension.handler');
        $extension = new $handler($request);
        $extension->handle();
        $extension->notify();

        return [];
    }
}
