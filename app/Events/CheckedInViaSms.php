<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Jobs\SendSubscribedNotificationsJob;
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
            'can find it at the DisasterCheckin site or by texting SEARCH. Send "CANCEL"',
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
        $phone_number = PhoneNumber::findByValueOrCreate($this->phone_number);

        $phone_number->update(['is_opted_out' => false]);

        SendSubscribedNotificationsJob::dispatch($phone_number)
            ->delay(120);

        return $phone_number->check_ins()->updateOrCreate(
            attributes: ['id' => $this->id],
            values: ['body' => $this->update],
        );
    }
}
