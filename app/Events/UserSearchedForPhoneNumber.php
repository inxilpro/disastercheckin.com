<?php

namespace App\Events;

use App\Models\PhoneNumber;
use Thunk\Verbs\Event;

class UserSearchedForPhoneNumber extends Event
{
    public string $phone_number;

    public function handle(): PhoneNumber
    {
        return PhoneNumber::firstOrCreate([
            'phone' => $this->phone_number,
        ]);
    }
}
