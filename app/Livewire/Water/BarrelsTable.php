<?php

namespace App\Livewire\Water;

use App\Events\BarrelDecommissioned;
use App\Events\BarrelDeployed;
use App\Events\BarrelRefilled;
use App\Livewire\Forms\BarrelForm;
use App\Models\Barrel;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BarrelsTable extends Component
{
    public BarrelForm $new_barrel;

    #[Computed]
    public function barrels()
    {
        return Barrel::query()
            ->orderByDesc('refill_requested_at')
            ->orderByDesc('refilled_at')
            ->orderBy('decommissioned_at')
            ->orderByDesc('code')
            ->get();
    }

    public function deployNew()
    {
        BarrelDeployed::commit(
            code: $this->new_barrel->code,
            address_street: $this->new_barrel->address_street,
            address_city: $this->new_barrel->address_city,
            address_state: $this->new_barrel->address_state,
            address_zip: $this->new_barrel->address_zip,
        );
    }

    public function markRefilled(string $barrel_id)
    {
        BarrelRefilled::commit(
            barrel_id: (int) $barrel_id,
            refilled_by: 'Staff',
        );
    }

    public function markDecommissioned(string $barrel_id)
    {
        BarrelDecommissioned::commit(
            barrel_id: (int) $barrel_id,
        );
    }

    public function render()
    {
        return view('livewire.water.barrels-table');
    }
}
