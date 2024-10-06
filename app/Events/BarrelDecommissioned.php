<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\BarrelState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class BarrelDecommissioned extends Event
{
    #[StateId(BarrelState::class)]
    public int $barrel_id;

    public function apply(BarrelState $barrel)
    {
        $barrel->refill_requested_at = null;
        $barrel->refill_requested_by = null;
        $barrel->refilled_at = null;
        $barrel->refilled_by = null;
        $barrel->decommissioned_at = now();
    }

    public function handle(BarrelState $barrel)
    {
        $barrel->model()->update(
            [
                'refill_requested_at' => null,
                'refill_requested_by' => null,
                'refilled_at' => null,
                'refilled_by' => null,
                'decommissioned_at' => $barrel->decommissioned_at
            ]
        );
    }
}
