<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerStatus>
 */
class CustomerStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_name' => fake()->randomElement(['Active','Deactivate','Banned']),
            'reason' => fake()->optional()->sentence(),
        ];
    }
}
