<?php

$prefix = (config('google-ads-lead-extension.prefix')) ? config('google-ads-lead-extension.prefix') : 'google-ads';

Route::group(['prefix' => $prefix, 'namespace' => 'Marshmallow\GoogleAdsLeadExtension\Http'], function () {
	Route::post('/lead-extension', 'GoogleAdsLeadExtensionController@index')->name('GoogleAdsLeadExtensionController@index');
});
