<?php

namespace Database\Factories;

use App\Models\RentalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalStatus>
 */
class RentalStatusFactory extends Factory
{
    protected $model = RentalStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_name' => $this->faker->randomElement([
                'Active',
                'Overdue',
                'Cancelled',
                'Returned'
            ])
        ];
    }
}
