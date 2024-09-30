<?php

namespace App\Parser;

class SmsParser
{
    /**
     * @param array $data
     * @return SmsCommand
     */
    public static function parse(array $data): SmsCommand
    {
        $body = trim($data['Body'] ?? '');

        $lower_body = strtolower(trim($body));
        $phone_number = $data['From'];

        if(str_starts_with($lower_body, 'update')) {
            return new SmsCommand(
                command: SmsCommandType::Update,
                phone_number: $phone_number,
                message: self::trimCommandText('update', $body),
            );
        }

        if(str_starts_with($lower_body, 'help')) {
            return new SmsCommand(
                command: SmsCommandType::Help,
                phone_number: $phone_number,
                message: self::trimCommandText('help', $body),
            );
        }

        $stop_words = ['stop', 'no', 'cancel'];
        $opts_out = collect($stop_words)->filter(fn($word) => str_starts_with($lower_body, $word))->values();

        if($opts_out->isNotEmpty()) {
            return new SmsCommand(
                command: SmsCommandType::OptOut,
                phone_number: $phone_number,
                message: self::trimCommandText($opts_out[0], $body),
            );
        }

        return new SmsCommand(
            command: SmsCommandType::Invalid,
            phone_number: $phone_number,
            message: $body,
        );
    }

    public static function trimCommandText(string $command, string $body): string
    {
        return trim(substr($body, strlen($command)));
    }
}
