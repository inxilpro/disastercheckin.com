<?php

namespace App\Data;

class SmsCommand
{
    public function __construct(
        public SmsCommandType $command,
        public string $message,
    ) {}
}
