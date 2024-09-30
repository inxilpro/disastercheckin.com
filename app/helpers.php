<?php

use App\Models\PhoneNumber;
use Propaganistas\LaravelPhone\PhoneNumber as BasePhoneNumber;
use Propaganistas\LaravelPhone\PhoneNumber as PhoneNumberParser;

function e164(PhoneNumber|BasePhoneNumber|string $value, string $country = 'US'): string
{
    if ($value instanceof PhoneNumber) {
        $value = $value->value;
    }

    if ($value instanceof BasePhoneNumber) {
        return $value->formatE164();
    }

    return (new PhoneNumberParser($value, $country))->formatE164();
}
