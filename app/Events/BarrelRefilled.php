<?php

namespace App\Events;

use Thunk\Verbs\Event;
use App\States\BarrelState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class BarrelRefilled extends Event
{
    #[StateId(BarrelState::class)]
    public int $barrel_id;
    public string $refilled_by;

    public function apply(BarrelState $barrel)
    {
        $barrel->refill_requested_at = null;
        $barrel->refill_requested_by = null;
        $barrel->refilled_at = now();
        $barrel->refilled_by = $this->refilled_by;
    }

    public function handle(BarrelState $barrel)
    {
        $barrel->model()->update(
            [
                'refill_requested_at' => null,
                'refill_requested_by' => null,
                'refilled_at' => now(),
                'refilled_by' => $this->refilled_by,
            ]
        );
    }
}
