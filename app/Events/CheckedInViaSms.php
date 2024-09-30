<?php

namespace App\Events;

use App\Data\SmsCommandType;
use App\Http\Responses\TwilioResponse;
use App\Models\PhoneNumber;
use Thunk\Verbs\Event;

class CheckedInViaSms extends Event
{
    public function __construct(
        public string $phone_number,
        public string $update,
        public array $payload,
    ) {}

    public function handle()
    {
        $phone_number = PhoneNumber::firstOrCreate([
            'value' => $this->phone_number,
        ]);

        $phone_number->check_ins()->create([
            'body' => $this->update,
        ]);

        return TwilioResponse::forSmsCommand(SmsCommandType::Update);
    }
}
