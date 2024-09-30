<?php

use App\Models\PhoneNumber;
use Propaganistas\LaravelPhone\PhoneNumber as BasePhoneNumber;

function phone_number(PhoneNumber|BasePhoneNumber|string $phone_number, string $country = 'US')
{
    if ($phone_number instanceof PhoneNumber) {
        $phone_number = $phone_number->value;
    }

    if ($phone_number instanceof BasePhoneNumber) {
        return $phone_number;
    }

    return new BasePhoneNumber($phone_number, $country);
}

function e164(PhoneNumber|BasePhoneNumber|string $value, string $country = 'US'): string
{
    return phone_number($value, $country)->formatE164();
}
