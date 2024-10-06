<?php

namespace App\SmsCommands;

use App\Data\SmsCommand;
use Illuminate\Support\Collection;

class Sms extends SmsCommand
{
    protected Collection $commands;

    public function __construct()
    {
        $this->commands = collect();
    }

    public function processMessage(string $message)
    {
        $this->matchCommand($message)->handle($message);
    }

    public function matchCommand(string $message)
    {
        $first_word = str($message)->words(1)->toString();

        return $this->commands->get($first_word);
    }
}