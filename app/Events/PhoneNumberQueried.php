<?php

namespace App\Events;

use App\Models\PhoneNumber;
use Thunk\Verbs\Event;

/** @method static PhoneNumber commit(string $phone_number) */
class PhoneNumberQueried extends Event
{
    public string $phone_number;

    public function handle(): PhoneNumber
    {
        return PhoneNumber::firstOrCreate([
            'value' => $this->phone_number,
        ]);
    }
}
