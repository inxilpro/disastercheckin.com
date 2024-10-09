<?php

namespace Database\Seeders;

use App\Models\CheckIn;
use App\Models\PhoneNumber;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        $carpet = PhoneNumber::factory()->create([
            'value' => '+18005882300',
        ]);
        CheckIn::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);
        CheckIn::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);

        Subscription::factory()->create([
            'user_id' => $user->id,
            'phone_number_id' => $carpet->id,
        ]);
    }
}
