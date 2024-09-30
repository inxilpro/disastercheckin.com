<?php

use App\Data\SmsCommand;
use App\Data\SmsCommandType;
use App\Data\SmsParser;

test('Creates a command', function () {
    $parsed = SmsParser::parse('Hi');

    assert($parsed instanceof SmsCommand);

    expect($parsed->command)->toBe(SmsCommandType::Invalid)
        ->and($parsed->message)->toBe('Hi');
})->group('parser');

test('Update command is parsed', function () {
    $parsed = SmsParser::parse("update i'm doing alright");
    expect($parsed->command)->toBe(SmsCommandType::Update);

    $parsed = SmsParser::parse("UpDaTe i'm doing alright");
    expect($parsed->command)->toBe(SmsCommandType::Update);

    $parsed = SmsParser::parse("update: i'm doing alright");
    expect($parsed->command)->toBe(SmsCommandType::Update)
        ->and($parsed->message)->toBe("i'm doing alright");

    $parsed = SmsParser::parse("UPDATEi'm doing alright");
    expect($parsed->command)->toBe(SmsCommandType::Update)
        ->and($parsed->message)->toBe("i'm doing alright");
})->group('parser');

test('Help command is parsed', function () {
    $parsed = SmsParser::parse('help abcd');
    expect($parsed->command)->toBe(SmsCommandType::Help);

    $parsed = SmsParser::parse('Helpabcd');
    expect($parsed->command)->toBe(SmsCommandType::Help);

    $parsed = SmsParser::parse("HELP'''abcd");
    expect($parsed->command)->toBe(SmsCommandType::Help)
        ->and($parsed->message)->toBe("'''abcd");
})->group('parser');

test('Opt out is parsed', function () {
    $parsed = SmsParser::parse('stop abcd');
    expect($parsed->command)->toBe(SmsCommandType::OptOut);

    $parsed = SmsParser::parse('cancel hi');
    expect($parsed->command)->toBe(SmsCommandType::OptOut);
})->group('parser');
