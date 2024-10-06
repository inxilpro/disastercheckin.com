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

        return __('sms.check-in-received');
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

        return $phone_number->check_ins()->updateOrCreate(
            attributes: ['id' => $this->id],
            values: ['body' => $this->update],
        );
    }
}
