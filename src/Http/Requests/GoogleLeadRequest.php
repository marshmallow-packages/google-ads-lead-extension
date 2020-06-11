<?php

namespace Marshmallow\GoogleAdsLeadExtension\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Marshmallow\GoogleAdsLeadExtension\Rules\GoogleKeyRule;

class GoogleLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'lead_id' => [
				'required', 'string'
			],
			'api_version' => [
				'required', 'string'
			],
			'form_id' => [
				'required', 'int'
			],
			'campaign_id' => [
				'required', 'int'
			],
			'google_key' => [
				'required', 'string', new GoogleKeyRule
			]
        ];
    }
}
