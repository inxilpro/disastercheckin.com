<?php

use App\Parser\SmsCommandType;

test('Creates a command', function () {
    /*
     * Provided by Chris as the Twillio data format
     */
    $sms_message = [
        "ToCountry" => "US",
        "ToState" => "NC",
        "SmsMessageSid" => "SMb636ddd1145fa485c2955081811ce627",
        "NumMedia" => "0",
        "ToCity" => null,
        "FromZip" => "19611",
        "SmsSid" => "SMb636ddd1145fa485c2955081811ce627",
        "FromState" => "PA",
        "SmsStatus" => "received",
        "FromCity" => "READING",
        "Body" => "Hi",
        "FromCountry" => "US",
        "To" => "+18288880440",
        "MessagingServiceSid" => "MG8906a0d53042fe5da25a86474f7e6b15",
        "ToZip" => null,
        "NumSegments" => "1",
        "MessageSid" => "SMb636ddd1145fa485c2955081811ce627",
        "AccountSid" => "ACb23d55d6d8e5f84ff488dbc6bf9c2160",
        "From" => "+0000000000",
        "ApiVersion" => "2010-04-01",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);

    assert($parsed instanceof \App\Parser\SmsCommand);

    expect($parsed->command)->toBe(SmsCommandType::Invalid);
    expect($parsed->phone_number)->toBe($sms_message['From']);
    expect($parsed->message)->toBe($sms_message['Body']);
})->group('parser');

test('Update command is parsed', function () {
    $sms_message = [
        "Body" => "update i'm doing alright",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Update);

    $sms_message = [
        "Body" => "UpDaTe i'm doing alright",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Update);

    $sms_message = [
        "Body" => "UPDATEi'm doing alright",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Update);
    expect($parsed->message)->toBe("i'm doing alright");
})->group('parser');

test('Help command is parsed', function () {
    $sms_message = [
        "Body" => "help abcd",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Help);

    $sms_message = [
        "Body" => "Helpabcd",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Help);

    $sms_message = [
        "Body" => "HELP'''abcd",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::Help);
    expect($parsed->message)->toBe("'''abcd");
})->group('parser');

test('Opt out is parsed', function () {
    $sms_message = [
        "Body" => "stop abcd",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::OptOut);

    $sms_message = [
        "Body" => "cancel hi",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::OptOut);

    $sms_message = [
        "Body" => "no i dont want",
        "To" => "+18288880440",
        "From" => "+0000000000",
    ];

    $parsed = \App\Parser\SmsParser::parse($sms_message);
    expect($parsed->command)->toBe(SmsCommandType::OptOut);
})->group('parser');
