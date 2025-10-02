<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'full_name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'address' => fake()->address(),
        'contact_number' => fake()->phoneNumber(),
        'measurement' => [
            'height' => fake()->numberBetween(150, 200),
            'weight' => fake()->numberBetween(50, 100),
            'chest'  => fake()->numberBetween(80, 120),
            'waist'  => fake()->numberBetween(60, 100),
            'hips'   => fake()->numberBetween(80, 120),
        ],
            // Ensure a valid foreign key to customer_status table
            'status_id' => CustomerStatus::query()->inRandomOrder()->value('status_id')
                ?? CustomerStatus::factory(),
        ];
    }
}
