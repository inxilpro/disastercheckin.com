<?php

namespace App\States;

use App\Models\Barrel;
use Thunk\Verbs\State;
use Illuminate\Support\Carbon;

class BarrelState extends State
{
    public string $code;

    public string $address_street;
    public string $address_city;
    public string $address_state;
    public string $address_zip;

    public ?Carbon $refill_requested_at = null;
    public ?string $refill_requested_by = null;

    public ?Carbon $refilled_at = null;
    public ?string $refilled_by = null;
    
    public ?Carbon $decommissioned_at = null;

    public function model()
    {
        return Barrel::find($this->id);
    }
}
