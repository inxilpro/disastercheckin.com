<?php

use App\Data\SmsCommandType;
use App\Data\SmsParser;
use App\Events\CheckedInViaSms;
use App\Events\OptOutRequested;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Propaganistas\LaravelPhone\PhoneNumber;

use function Laravel\Prompts\note;
use function Laravel\Prompts\text;

Artisan::command('sms', function () {
    $raw_phone = text('Phone number', default: '202-456-1111', required: true, validate: fn ($value) => (new PhoneNumber($value, 'US'))->isValid() ? null : 'Invalid phone number');
    $raw_body = text('Message body', required: true, validate: fn ($value) => mb_strlen($value) <= 160 ? null : 'Message must be under 160 chars');

    $synthetic_payload = ['raw_phone' => $raw_phone, 'raw_body' => $raw_body, 'synthetic' => true];

    $phone_number = e164($raw_phone);
    $command = SmsParser::parse($raw_body);

    $response = match ($command->command) {
        SmsCommandType::Update => CheckedInViaSms::commit(
            phone_number: $phone_number,
            update: $command->message,
            payload: $synthetic_payload,
        ),
        SmsCommandType::OptOut => OptOutRequested::commit(
            phone_number: $phone_number,
            payload: $synthetic_payload,
        ),
        default => 'Please start your message with the word "UPDATE" (eg. UPDATE I am doing OK!)',
    };

    note((string) $response);
});

Schedule::command('cloudflare:reload')->daily();
