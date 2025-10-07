<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\User;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-6 months', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');
        
        return [
            'customer_id' => Customer::factory(),
            'item_id' => Inventory::factory(),
            'reserved_by' => User::factory(),
            'reservation_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'status_id' => ReservationStatus::factory(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
