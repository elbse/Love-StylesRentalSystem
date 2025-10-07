<?php

namespace Database\Factories;

use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentStatus>
 */
class PaymentStatusFactory extends Factory
{
    protected $model = PaymentStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_name' => $this->faker->randomElement([
                'Pending',
                'Completed',
                'Failed',
                'Refunded',
                'Cancelled'
            ])
        ];
    }
}
