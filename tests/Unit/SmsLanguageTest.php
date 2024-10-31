<?php

use Illuminate\Support\Arr;

test('It replies with messages under 160 characters', function () {
    $messages = Arr::dot(include('lang/en/sms.php'));

    foreach ($messages as $key => $message) {
        expect(strlen($message))->toBeLessThan(160, "[$key] $message is longer than 160 characters");
    }
})->group('lang');
