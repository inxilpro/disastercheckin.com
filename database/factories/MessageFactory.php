<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
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
