<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Jobs\SendToDiscord;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Thunk\Verbs\Event;

class SubmittedFyi extends Event
{
    public static function webhook(Request $request, SmsCommand $command): string
    {
        static::commit(
            phone_number: $request->input('From'),
            message: $command->message,
            payload: $request->all(),
        );

        return 'Thanks! This information will be reviewed shortly.';
    }

    public function __construct(
        public string $phone_number,
        public string $message,
        public array $payload,
        public string $channel = 'default'
    ) {}

    public function handle()
    {
        $phone_number = PhoneNumber::findByValueOrCreate($this->phone_number);

        $phone_number->update(['is_opted_out' => false]);

        $formatted_number = phone_number($phone_number)->formatNational();

        SendToDiscord::dispatch(
            message: "**{$formatted_number}**\n```$this->message```",
            channel: $this->channel,
        );
    }
}
