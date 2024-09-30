<?php

namespace App\Parser;

class SmsCommand
{
    public function __construct(
        public SmsCommandType $command,
        public string $phone_number,
        public string $message,
    ) {}
}
