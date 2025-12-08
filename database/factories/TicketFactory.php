<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'topic' => fake()->sentence(),
            'text' => fake()->paragraph(),
            'status' => fake()->randomElement([0, 1]),
            'date_of_response' => fake()->dateTimeBetween('-5 months', '+5 months'),
        ];
    }
}
