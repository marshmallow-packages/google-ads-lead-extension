<?php

namespace Marshmallow\GoogleAdsLeadExtention\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Marshmallow\GoogleAdsLeadExtention\App\GoogleAdsLeadExtentionBase;

class GoogleAdsLeadExtentionNotifier extends Mailable
{
    use Queueable, SerializesModels;

    private $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(GoogleAdsLeadExtentionBase $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('google-ads-lead-extention::newLead')
                    ->with([
                        'lead' => $this->lead
                    ])
                    ->from('info@marshmallow.dev')
                    ->subject('New lead via Google Ads!');
    }
}
