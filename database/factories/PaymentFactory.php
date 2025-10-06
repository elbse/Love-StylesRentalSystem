<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Rental;
use App\Models\Reservation;
use App\Models\User;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentTypes = ['deposit', 'rental_fee'];
        $paymentMethods = ['cash', 'card', 'bank_transfer'];
        
        return [
            'rental_id' => Rental::factory(),
            'reservation_id' => Reservation::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'payment_type' => $this->faker->randomElement($paymentTypes),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'payment_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'processed_by' => User::factory(),
            'status_id' => PaymentStatus::factory(),
        ];
    }
}
