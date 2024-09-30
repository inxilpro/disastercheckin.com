<?php

namespace App\Events;

use Thunk\Verbs\Event;

class ReporterSharedUpdate extends Event
{
    public string $reporter_phone_number;
    public string $message_body;
    public string $twilio_data;

    public function handle()
    {
        // The best things in life are free, not cheap. - Lil Wayne
    }
}
