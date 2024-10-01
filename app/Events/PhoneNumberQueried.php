<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Thunk\Verbs\Event;

/** @method static PhoneNumber commit(string $phone_number) */
class PhoneNumberQueried extends Event
{
    public string $phone_number;

    public static function webhook(Request $request, SmsCommand $command): string
    {
        // TODO: Account for numbers with spaces :/

        $found = static::commit(
            phone_number: str($command->message)
                ->trim()
                ->explode(' ')
                ->filter(fn ($word) => phone_number($word)->isValid())
                ->first() ?? '',
        );

        if ($check_in = $found->check_ins()->latest()->first()) {
            return Str::limit("[{$check_in->created_at->diffForHumans()}] {$check_in->body}", 160);
        }

        return implode(' ', [
            "We weren’t able to find any updates for {$found->value}. You can subscribe",
            'to updates at the disaster check-in website.',
        ]);
    }

    public function validate()
    {
        $this->assert(
            assertion: phone_number($this->phone_number)->isValid(),
            message: 'The phone number you searched for does not appear to be valid.',
        );
    }

    public function handle(): PhoneNumber
    {
        return PhoneNumber::findByValueOrCreate($this->phone_number);
    }
}
