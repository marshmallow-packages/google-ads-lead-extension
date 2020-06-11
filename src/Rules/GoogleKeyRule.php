<?php

namespace Marshmallow\GoogleAdsLeadExtension\Rules;

use Illuminate\Contracts\Validation\Rule;

class GoogleKeyRule implements Rule
{
	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		if (!env('GOOGLE_ADS_LEAD_EXTENTION_KEY')) {
			return false;
		}
		if (env('GOOGLE_ADS_LEAD_EXTENTION_KEY') !== $value) {
			return false;
		}
		return true;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'The provided key doesnt match the generated `GOOGLE_ADS_LEAD_EXTENTION_KEY`.';
	}
}
