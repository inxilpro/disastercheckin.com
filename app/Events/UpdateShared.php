<?php

namespace App\Events;

use App\Http\Responses\TwilioResponse;
use App\Models\PhoneNumber;
use Thunk\Verbs\Event;

class UpdateShared extends Event
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

        return TwilioResponse::make()
            ->message('Your update has been saved and will be public to anyone who knows your phone number.');
    }
}
