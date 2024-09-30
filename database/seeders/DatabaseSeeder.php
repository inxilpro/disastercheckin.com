<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\PhoneNumber;
use App\Models\User;
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
        Message::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);
        Message::factory()->create([
            'phone_number_id' => $carpet->id,
        ]);
    }
}
