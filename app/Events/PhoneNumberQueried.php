<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber as BasePhoneNumber;
use Thunk\Verbs\Event;

/** @method static PhoneNumber commit(string $phone_number) */
class PhoneNumberQueried extends Event
{
    public string $phone_number;

    public static function webhook(Request $request, SmsCommand $command): string
    {
        $found = static::commit(
            phone_number: str($command->message)
                ->trim()
                ->explode(' ')
                ->filter(fn ($token) => (new BasePhoneNumber($token, 'US'))->isValid())
                ->first(),
        );

        // TODO: We may need to account for SMS length limits here
        if ($check_in = $found->check_ins()->latest()->first()) {
            return implode(' ', [
                "From {$found->value} {$check_in->created_at->diffForHumans()}:",
                $check_in->body,
            ]);
        }

        return implode(' ', [
            "We weren’t able to find any updates for {$found->value}. You can subscribe",
            'to updates at disastercheckin.com.',
        ]);
    }

    public function validate()
    {
        $this->assert(
            assertion: (new BasePhoneNumber($this->phone_number, 'US'))->isValid(),
            message: 'The phone number you searched for does not appear to be valid.',
        );
    }

    public function handle(): PhoneNumber
    {
        return PhoneNumber::findByValueOrCreate($this->phone_number);
    }
}
