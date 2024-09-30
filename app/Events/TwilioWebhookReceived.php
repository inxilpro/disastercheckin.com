<?php

namespace App\Events;

use Thunk\Verbs\Event;

class TwilioWebhookReceived extends Event
{
    public function __construct(
        public array $payload,
    ) {}
}
