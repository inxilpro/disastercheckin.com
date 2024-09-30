<?php

namespace Database\Factories;

use App\Models\CheckIn;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CheckIn>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_number_id' => PhoneNumber::factory(),
            'message' => fake()->paragraphs(2, true),
        ];
    }
}
