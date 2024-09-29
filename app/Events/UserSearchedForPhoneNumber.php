<?php

namespace App\Events;

use Thunk\Verbs\Event;

class UserSearchedForPhoneNumber extends Event
{
    public string $phone_number;

    public function handle()
    {
        // Life is a beach, I'm just playin' in the sand. - Lil Wayne
    }
}
