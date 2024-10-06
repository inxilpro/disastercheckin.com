<div class="mx-auto max-w-4xl space-y-6 mt-12">

    <div class="flex justify-between items-center">
        <div class="w-2/3">
            <flux:heading>
                Water Barrel Dashboard
            </flux:heading>
            <flux:subheading>
                Use this table of all of our deployed barrels to manage refilling. Users can request a refill by texting "refill: 55" (replace 55 with their barrel number) to <span class="strong">(828)888-0440</span>
            </flux:subheading>
        </div>

        <flux:modal.trigger name="add-barrel">
            <flux:button>Add a Barrel</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:card class="space-y-6">

        <flux:table>
            <flux:columns>
                <flux:column>No.</flux:column>
                <flux:column>Location</flux:column>
                <flux:column>Refill Status</flux:column>
                <flux:column>Actions</flux:column>
            </flux:columns>

            <flux:rows>
                @foreach($this->barrels as $barrel)
                    <flux:row>
                        <flux:cell variant="strong">
                            <span class="text-zinc-500 mr-1">#</span>{{$barrel->code}}
                        </flux:cell>
                        <flux:cell>
                            <flux:heading>
                                <flux:icon.map-pin class="size-4 inline text-rose-400 mr-2" />
                                {{ $barrel->address_street }}
                            </flux:heading>
                            <flux:subheading class="pl-8">
                                {{ $barrel->address_city }}, {{ $barrel->address_state }}, {{ $barrel->address_zip }}
                            </flux:subheading>
                        </flux:cell>
                        <flux:cell>
                            @if ($barrel->decommissioned_at)
                                <flux:heading>
                                    <flux:icon.no-symbol class="size-4 inline text-zinc-500 mr-2" />
                                    Decommissioned {{ $barrel->decommissioned_at->diffForHumans() }}
                                </flux:heading>
                            @elseif ($barrel->refill_requested_at)

                                <flux:heading>
                                    <flux:icon.exclamation-triangle class="size-4 inline text-amber-500 mr-2" />
                                    Requested {{ $barrel->refill_requested_at->diffForHumans() }}
                                </flux:heading>
                                
                                <flux:subheading class="pl-8">
                                    by {{ $barrel->refill_requested_by }}
                                </flux:subheading>
                            @elseif ($barrel->refilled_at)
                                <flux:heading>
                                    <flux:icon.check class="size-4 inline text-teal-500 mr-2" />
                                    Refilled {{ $barrel->refilled_at->diffForHumans() }}
                                </flux:heading>
                            @else
                                <span class="text-zinc-500">&mdash;</span>
                            @endif
                        </flux:cell>
                        <flux:cell>
                            <flux:dropdown>
                                <flux:button variant="ghost" icon-trailing="ellipsis-horizontal"></flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="check" wire:click="markRefilled('{{ $barrel->id }}')">Mark as Refilled</flux:menu.item>
                                    <flux:menu.item icon="no-symbol" wire:click="markDecommissioned('{{ $barrel->id }}')">Mark as Decommissioned</flux:menu.item>
                                    {{-- <flux:menu.item icon="arrow-path">Mark as Replaced</flux:menu.item> --}}
                                </flux:menu>
                            </flux:dropdown>
                        </flux:cell>
                    </flux:row>
                @endforeach
            </flux:rows>
        </flux:table>
    </flux:card>

    <flux:modal variant="flyout" name="add-barrel" class="md:w-96 space-y-6">
        <div>
            <flux:heading size="lg">Deploy a new barrel!</flux:heading>
            <flux:subheading>Look, dude these barrels aren't gonna deploy themselves.</flux:subheading>
        </div>

        <flux:input label="Barrel Number" wire:model="new_barrel.code" placeholder="69" />

        <flux:input label="Street Address" wire:model="new_barrel.address_street" placeholder="1 Main St."/>
        <flux:input label="City" wire:model="new_barrel.address_city" placeholder="Asheville" />
        <flux:input label="State" wire:model="new_barrel.address_state" placeholder="NC" />
        <flux:input label="Zip Code" wire:model="new_barrel.address_zip" placeholder="28806" />

        <div class="flex">
            <flux:spacer />

            <flux:button type="submit" wire:click="deployNew" variant="primary">Deploy Barrel!</flux:button>
        </div>
    </flux:modal>
</div>
