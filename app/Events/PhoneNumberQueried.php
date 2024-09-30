<?php

namespace App\Events;

use App\Data\SmsCommand;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber as BasePhoneNumber;
use Thunk\Verbs\Event;

/** @method static PhoneNumber commit(string $phone_number, ?string $email = null) */
class PhoneNumberQueried extends Event
{
    public string $phone_number;

    public ?string $email = null;

    public static function webhook(Request $request, SmsCommand $command): string
    {
        $found = static::commit(
            phone_number: str($command->message)
                ->trim()
                ->explode(' ')
                ->filter(fn ($token) => (new BasePhoneNumber($token, 'US'))->isValid())
                ->first() ?? '',
        );

        if ($check_in = $found->check_ins()->latest()->first()) {

            $timestamp = "{$check_in->created_at->diffForHumans()}:";
            $message = $check_in->body;
            $overflow = strlen($timestamp) + strlen($message) - 160;

            if($overflow > 0) {
                $message = substr($message, 0, strlen($message) - $overflow - 3) . '...';
            }

            return implode(' ', [
                $timestamp,
                $message,
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
        $phone_number = PhoneNumber::findByValueOrCreate($this->phone_number);

        if ($this->email) {
            $user = User::firstOrCreate(
                ['email' => $this->email],
                ['name' => str($this->email)->before('@'), 'password' => Str::random(32)],
            );

            $user->subscriptions()->firstOrCreate([
                'user_id' => $user->id,
                'phone_number_id' => $phone_number->id,
            ]);
        }

        return $phone_number;
    }
}
