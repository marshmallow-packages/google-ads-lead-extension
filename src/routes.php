<?php

use Illuminate\Support\Facades\Route;

$prefix = (config('google-ads-lead-extension.prefix')) ? config('google-ads-lead-extension.prefix') : 'google-ads';

Route::group(
    [
        'prefix' => $prefix,
        'namespace' => 'Marshmallow\GoogleAdsLeadExtension\Http',
    ],
    function () {
        Route::post(
            '/lead-extension',
            'GoogleAdsLeadExtensionController@index'
        )->name('GoogleAdsLeadExtension');

        /**
         * Temp alias because of a spelling mistake. We should
         * keep this here untill we go up te version 3.
         */
        Route::post(
            '/lead-extention',
            'GoogleAdsLeadExtensionController@index'
        );
    }
);
