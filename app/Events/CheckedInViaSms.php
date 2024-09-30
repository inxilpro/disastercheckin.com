<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Thunk\Verbs\Event;

class CheckedInViaSms extends Event
{
    public static function webhook(Request $request, SmsCommand $command): string
    {
        static::commit(
            phone_number: $request->input('From'),
            update: $command->message,
            payload: $request->all(),
        );

        return implode(' ', [
            'Your update has been saved. Anyone with your phone number',
            'can find your message at disastercheckin.com. Send "CANCEL"',
            'to remove all your updates.',
        ]);
    }

    public function __construct(
        public string $phone_number,
        public string $update,
        public array $payload,
    ) {}

    public function handle()
    {
        return PhoneNumber::findByValueOrCreate($this->phone_number)
            ->check_ins()
            ->create(['body' => $this->update]);
    }
}
