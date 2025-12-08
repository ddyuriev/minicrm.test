<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        $dateOfCreate = fake()->dateTimeBetween('-12 months', 'now');
        return [
            'customer_id' => Customer::factory(),
            'topic' => fake()->sentence(),
            'text' => fake()->paragraph(),
            'status' => fake()->randomElement([1, 2, 3]),
            'created_at' => $dateOfCreate,
            'date_of_response' => \Carbon\Carbon::instance($dateOfCreate)
                ->addDays(fake()->numberBetween(1, 14)),
        ];
    }
}
