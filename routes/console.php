<?php

use App\Events\CheckedInViaSms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Propaganistas\LaravelPhone\PhoneNumber;

use function Laravel\Prompts\note;
use function Laravel\Prompts\text;

Artisan::command('check-in', function () {
    $phone = text('Phone number', default: '202-456-1111', required: true, validate: fn ($value) => (new PhoneNumber($value, 'US'))->isValid() ? null : 'Invalid phone number');
    $body = text('Message body', required: true, validate: fn ($value) => mb_strlen($value) <= 160 ? null : 'Message must be under 160 chars');

    $response = CheckedInViaSms::commit(
        phone_number: (new PhoneNumber($phone, 'US'))->formatE164(),
        update: $body,
        payload: ['synthetic' => true],
    );

    note((string) $response);
});

Schedule::command('cloudflare:reload')->daily();
