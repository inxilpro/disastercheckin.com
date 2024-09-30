<?php

namespace Database\Seeders;

use App\Models\CheckIn;
use App\Models\PhoneNumber;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $carpet = PhoneNumber::factory()->create([
            'phone' => '+18005882300',
        ]);
        CheckIn::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);
        CheckIn::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);
    }
}
