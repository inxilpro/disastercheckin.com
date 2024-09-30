<?php

namespace App\Data;

class SmsCommand
{
    public function __construct(
        public SmsCommandType $command,
        public string $message,
    ) {}

    public function __toString(): string
    {
        return "'{$this->command->value}' command with message '{$this->message}'";
    }
}
