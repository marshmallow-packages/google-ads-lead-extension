<?php

namespace Marshmallow\GoogleAdsLeadExtension;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Marshmallow\GoogleAdsLeadExtension\Mail\GoogleAdsLeadExtensionNotifier;

class GoogleAdsLeadExtensionBase
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * [getLeadId description]
     * @return [type] [description]
     */
    public function getLeadId(): string
    {
        return $this->request->lead_id;
    }

    /**
     * [getFormId description]
     * @return [type] [description]
     */
    public function getFormId(): int
    {
        return $this->request->form_id;
    }

    /**
     * [getCampaignId description]
     * @return [type] [description]
     */
    public function getCampaignId(): int
    {
        return $this->request->campaign_id;
    }

    /**
     * [getApiVersion description]
     * @return [type] [description]
     */
    public function getApiVersion(): string
    {
        return $this->request->api_version;
    }

    /**
     * [getFullName description]
     * @return [type] [description]
     */
    public function getFullName(): ?string
    {
        return $this->getUserDataFromRequest('Full Name');
    }

    /**
     * [getPhoneNumber description]
     * @return [type] [description]
     */
    public function getPhoneNumber(): ?string
    {
        return $this->getUserDataFromRequest('User Phone');
    }

    /**
     * [getEmail description]
     * @return [type] [description]
     */
    public function getEmail(): ?string
    {
        return $this->getUserDataFromRequest('User Email');
    }

    /**
     * [getPostalCode description]
     * @return [type] [description]
     */
    public function getPostalCode(): ?string
    {
        return $this->getUserDataFromRequest('Postal Code');
    }

    /**
     * [isTest description]
     * @return bool [description]
     */
    public function isTest(): bool
    {
        return ($this->getRequest()->has('is_test') && $this->getRequest()->is_test === true);
    }

    /**
     * [getClickId description]
     * @return [type] [description]
     */
    public function getClickId(): ?string
    {
        if (! $this->getRequest()->has('gcl_id')) {
            return null;
        }

        return $this->getRequest()->gcl_id;
    }

    /**
     * [getGclId description]
     * @return [type] [description]
     */
    public function getGclId(): ?string
    {
        return $this->getClickId();
    }

    /**
     * [getRequest description]
     * @return [type] [description]
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * [getUserDataFromRequest description]
     * @param  [type] $column_name [description]
     * @return [type]              [description]
     */
    public function getUserDataFromRequest($column_name): ?string
    {
        foreach ($this->getRequest()['user_column_data'] as $data) {
            if ($data['column_name'] === $column_name) {
                return $data['string_value'];
            }
        }

        return null;
    }

    /**
     * [notify description]
     * @return [type] [description]
     */
    public function notify()
    {
        $send_mail_to = config('google-ads-lead-extension.conversion-email-address');
        if ($send_mail_to) {
            Mail::to($send_mail_to)->send(new GoogleAdsLeadExtensionNotifier($this));
        }
    }
}
