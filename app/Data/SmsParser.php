<?php

namespace App\Data;

class SmsParser
{
    protected const PREFIXES = ['update', 'search', 'help', 'stop', 'cancel', 'subscribe'];

    public static function parse(string $body): SmsCommand
    {
        [$prefix, $message] = static::split($body);

        return new SmsCommand(
            command: match ($prefix) {
                'update' => SmsCommandType::Update,
                'search' => SmsCommandType::Search,
                'help' => SmsCommandType::Help,
                'stop', 'cancel' => SmsCommandType::OptOut,
                'subscribe' => SmsCommandType::Subscribe,
                default => SmsCommandType::Invalid,
            },
            message: $message,
        );
    }

    protected static function split(string $body): array
    {
        $prefixes = collect(static::PREFIXES)
            ->map(fn ($prefix) => preg_quote($prefix, '/'))
            ->implode('|');

        preg_match('/^\s*(?P<command>'.$prefixes.')?:?\s*(?P<message>.*)\s*$/i', $body, $matches);

        return [
            strtolower($matches['command'] ?? ''),
            $matches['message'] ?? '',
        ];
    }
}
