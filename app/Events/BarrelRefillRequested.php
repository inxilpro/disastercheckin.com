<?php

namespace App\Events;

use App\Models\Barrel;
use Thunk\Verbs\Event;
use App\Data\SmsCommand;
use App\States\BarrelState;
use Illuminate\Http\Request;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class BarrelRefillRequested extends Event
{
    #[StateId(BarrelState::class)]
    public ?int $barrel_id;

    public string $requesting_phone_number;

    public static function webhook(Request $request, SmsCommand $command): string
    {
        $barrel_code = str($command->message)->trim()->toString();

        if (! is_numeric($barrel_code)) {
            return "$barrel_code is not a valid barrel number.";
        }

        $barrel = Barrel::firstWhere('code', $barrel_code);

        if (!$barrel) {
            return "We can't find a barrel with the number $barrel_code. Please email daniel@thunk.dev for help.";
        }

        $found = static::commit(
            barrel_id: $barrel->id,
            requesting_phone_number: $request->input('From'),
        );

        return 'Your refill request has been passed on to our volunteers! We will text you when your barrel is refilled.';
    }

    public function apply(BarrelState $barrel)
    {
        $barrel->refill_requested_at = now();
        $barrel->refill_requested_by = $this->requesting_phone_number;
    }

    public function handle(BarrelState $barrel)
    {
        $barrel->model()->update(
            [
                'refill_requested_at' => $barrel->refill_requested_at,
                'refill_requested_by' => $barrel->refill_requested_by,
            ]
        );
    }
}
