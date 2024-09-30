<?php

use Propaganistas\LaravelPhone\PhoneNumber as PhoneNumberParser;

function e164(string $value, string $country = 'US'): string
{
    return (new PhoneNumberParser($value, $country))->formatE164();
}
