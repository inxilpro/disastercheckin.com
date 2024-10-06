<?php

namespace App\States;

use Illuminate\Support\Carbon;
use Thunk\Verbs\State;

class BarrelState extends State
{
    public string $code;

    public string $address_street;
    public string $address_city;
    public string $address_state;
    public string $address_zip;

    public ?Carbon $refill_requested_at = null;
    public ?int $refill_requested_by = null;
}
