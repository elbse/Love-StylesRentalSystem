<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\Reservation;
use App\Models\User;
use App\Models\RentalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    protected $model = Rental::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $releasedDate = $this->faker->dateTimeBetween('-6 months', 'now');
        $dueDate = $this->faker->dateTimeBetween($releasedDate, '+30 days');
        $returnDate = $this->faker->optional(0.8)->dateTimeBetween($releasedDate, $dueDate);
        
        // Calculate penalty fee if overdue
        $penaltyFee = 0;
        if ($returnDate && $returnDate > $dueDate) {
            $daysOverdue = $returnDate->diffInDays($dueDate);
            $penaltyFee = $daysOverdue * 50; // 50 pesos per day overdue
        } elseif (!$returnDate && now() > $dueDate) {
            $daysOverdue = now()->diffInDays($dueDate);
            $penaltyFee = $daysOverdue * 50;
        }
        
        return [
            'reservation_id' => Reservation::factory(),
            'released_by' => User::factory(),
            'released_date' => $releasedDate,
            'due_date' => $dueDate,
            'return_date' => $returnDate,
            'status_id' => RentalStatus::factory(),
            'penalty_fee' => $penaltyFee,
        ];
    }
}
