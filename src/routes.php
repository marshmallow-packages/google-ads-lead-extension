<?php

$prefix = (config('google-ads-lead-extention.prefix')) ? config('google-ads-lead-extention.prefix') : 'google-ads';

Route::group(['prefix' => $prefix, 'namespace' => 'Marshmallow\GoogleAdsLeadExtention\App\Http'], function(){
	Route::post('/lead-extention', 'GoogleAdsLeadExtentionController@index')->name('GoogleAdsLeadExtentionController@index');
});