<?php

namespace Database\Factories;

use App\Models\PhoneNumber;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subscriber' => PhoneNumber::factory(),
            'subscribed_to' => PhoneNumber::factory(),
        ];
    }
}
