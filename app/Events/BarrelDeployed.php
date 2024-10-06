<?php

namespace App\Events;

use App\Models\Barrel;
use Thunk\Verbs\Event;
use App\Data\SmsCommand;
use App\States\BarrelState;
use Symfony\Component\HttpFoundation\Request;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class BarrelDeployed extends Event
{
    #[StateId(BarrelState::class)]
    public ?int $barrel_id = null;

    public string $code;

    public string $address_street;
    public string $address_city;
    public string $address_state;
    public string $address_zip;

    public static function webhook(Request $request, SmsCommand $command): string
    {
        $barrel_code = str($command->message);

        dd($barrel_code);

        return 'foobar';
    }

    public function apply(BarrelState $barrel)
    {
        $barrel->code = $this->code;

        $barrel->address_street = $this->address_street;
        $barrel->address_city = $this->address_city;
        $barrel->address_state = $this->address_state;
        $barrel->address_zip = $this->address_zip;
    }

    public function handle(BarrelState $barrel)
    {
        Barrel::updateOrCreate(
            ['id' => $barrel->id],
            [
                'code' => $this->code,
                'address_street' => $this->address_street,
                'address_city' => $this->address_city,
                'address_state' => $this->address_state,
                'zip' => $this->address_zip,
                'refill_requested_at' => null,
                'refill_requested_by' => null,
            ]
        );
    }
}
