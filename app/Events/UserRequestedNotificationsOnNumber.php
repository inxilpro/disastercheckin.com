<?php

namespace App\Events;

use Thunk\Verbs\Event;

class UserRequestedNotificationsOnNumber extends Event
{
    public string $searcher_phone_number;
    public string $searchee_phone_number;

    public function handle()
    {
        // I need a Wynn-Dixie grocery bag full of money rig  - Lil Wayne
    }
}
