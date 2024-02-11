<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberType;

class ValidationPhone implements Rule
{
    public function passes($attribute, $value)
    {
        // Create an instance of PhoneNumberUtil
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $user_ip = getenv('REMOTE_ADDR');
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
            $phoneNumber = $phoneUtil->parse($value, $geo['geoplugin_countryCode']);
            $isMobile = $phoneUtil->getNumberType($phoneNumber) === PhoneNumberType::MOBILE;
            return $isMobile;
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }
    }
    public function message()
    {
        return 'Please Provide a valid mobile phone number.';
    }
}
