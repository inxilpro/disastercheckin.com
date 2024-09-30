<?php

namespace App\Events;

use App\Data\SmsCommandType;
use App\Http\Responses\TwilioResponse;
use Thunk\Verbs\Event;

class OptOutRequested extends Event
{
    public function __construct(
        public string $phone_number,
        public array $payload,
    ) {}

    public function handle()
    {
        return TwilioResponse::forSmsCommand(SmsCommandType::OptOut);
    }
}
