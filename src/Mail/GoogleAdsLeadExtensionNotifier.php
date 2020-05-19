<?php

namespace Marshmallow\GoogleAdsLeadExtension\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Marshmallow\GoogleAdsLeadExtension\GoogleAdsLeadExtensionBase;

class GoogleAdsLeadExtensionNotifier extends Mailable {
	use Queueable, SerializesModels;

	private $lead;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(GoogleAdsLeadExtensionBase $lead) {
		$this->lead = $lead;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown('google-ads-lead-extension::newLead')
			->with([
				'lead' => $this->lead,
			])
			->from('info@marshmallow.dev')
			->subject('New lead via Google Ads!');
	}
}
