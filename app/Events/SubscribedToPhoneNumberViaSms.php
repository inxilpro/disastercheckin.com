<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Thunk\Verbs\Event;

class SubscribedToPhoneNumberViaSms extends Event
{
    public static function webhook(Request $request, SmsCommand $command): string
    {
        static::commit(
            user_phone_number: $request->input('From'),
            reporter_phone_number: $command->message,
            payload: $request->all(),
        );

        return implode(' ', [
            // TODO
        ]);
    }
    
    public function __construct(
        public string $user_phone_number,
        public string $reporter_phone_number,
        public array $payload,
    ) {}

    public function validate()
    {
        $this->assert(
            assertion: phone_number($this->reporter_phone_number)->isValid(),
            message: 'The phone number you are subscribing to does not appear to be valid.',
        );
    }

    public function handle(): PhoneNumber
    {
        $phone_number = PhoneNumber::findByValueOrCreate($this->reporter_phone_number);

        $user = User::firstOrCreate(
            ['phone_number' => $this->user_phone_number],
            [
                'name' => '',
                'password' => Str::random(32),
            ],
        );

        $user->subscriptions()->firstOrCreate([
            'user_id' => $user->id,
            'phone_number_id' => $phone_number->id,
        ]);

        return $phone_number;
    }
}
