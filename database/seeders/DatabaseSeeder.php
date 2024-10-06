<?php

namespace Database\Seeders;

use App\Models\CheckIn;
use App\Models\PhoneNumber;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Events\BarrelDeployed;
use App\Events\BarrelRefillRequested;
use App\Models\Barrel;
use Thunk\Verbs\Facades\Verbs;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class DatabaseSeeder extends Seeder
{
    use WithFaker;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $carpet = PhoneNumber::factory()->create([
        //     'value' => '+18005882300',
        // ]);

        // CheckIn::factory()->create([
        //     'phone_number_id' => $carpet->id,
        // ]);

        // CheckIn::factory()->create([
        //     'phone_number_id' => $carpet->id,
        // ]);

        $barrel_ids = collect(range(1, 24))->map(function ($code) {
            return BarrelDeployed::fire(
                code: (string) $code,
                address_street: fake()->streetAddress(),
                address_city: fake()->city(),
                address_state: fake()->state(),
                address_zip: (string) rand(28800, 28806),
            )->barrel_id;
        });

        $barrel_ids->random(3)->each(function ($barrel_id) {
            BarrelRefillRequested::fire(
                barrel_id: $barrel_id,
                requesting_phone_number: e164(fake()->phoneNumber())
            );
        });

        Verbs::commit();
    }
}
