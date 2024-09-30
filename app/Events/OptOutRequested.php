<?php

namespace App\Events;

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
        return TwilioResponse::make()
            ->message('Any public messages that you have posted will be removed shortly!');
    }
}
