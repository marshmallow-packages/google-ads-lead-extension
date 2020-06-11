<?php

namespace Tests\Feature;

use Marshmallow\GoogleAdsLeadExtension\Tests\TestCase;

class EndpointTest extends TestCase
{
	public function testLeadIdIsRequired()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertJsonValidationErrors([
			'lead_id'
		]);
	}

	public function testItThrowsAnErrorIfLeadIdIsAnInteger()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'lead_id' => 123,
			]
		)->assertJsonValidationErrors([
			'lead_id'
		]);
	}

	public function testApiVersionIsRequired()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertJsonValidationErrors([
			'api_version'
		]);
	}

	public function testItThrowsAnErrorIfApiVersionIsAnInteger()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'api_version' => 123,
			]
		)->assertJsonValidationErrors([
			'api_version'
		]);
	}

	public function testFormIdIsRequired()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertJsonValidationErrors([
			'form_id'
		]);
	}

	public function testItThrowsAnErrorIfFormIdIsNotAnInteger()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'form_id' => 'string',
			]
		)->assertJsonValidationErrors([
			'form_id'
		]);
	}

	public function testCampaignIdIsRequired()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertJsonValidationErrors([
			'campaign_id'
		]);
	}

	public function testItThrowsAnErrorIfCampaignIdIsNotAnInteger()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'campaign_id' => 'string',
			]
		)->assertJsonValidationErrors([
			'campaign_id'
		]);
	}

	public function testGoogleKeyIsRequired()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertJsonValidationErrors([
			'google_key'
		]);
	}

	public function testItThrowsAnErrorIfGoogleKeyIsNotAString()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'google_key' => 123,
			]
		)->assertJsonValidationErrors([
			'google_key'
		]);
	}

	public function testGoogleKeyNeedsToMatchEnvirment()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'google_key' => 'DOES_NOT_MATCH',
			]
		)->assertJsonValidationErrors([
			'google_key'
		]);

		$this->json(
			'POST',
			route('GoogleAdsLeadExtension'),
			[
				'google_key' => config('google-ads-lead-extension.key'),
			]
		)->assertJsonMissingValidationErrors([
			'google_key'
		]);
	}

	public function testApiEndpointIsAccessable()
	{
		$this->json(
			'POST',
			route('GoogleAdsLeadExtension')
		)->assertStatus(422);
	}

	public function testApiDoesnotWorkViaGet()
	{
		$this->json(
			'GET',
			route('GoogleAdsLeadExtension')
		)->assertStatus(405);
	}
}
