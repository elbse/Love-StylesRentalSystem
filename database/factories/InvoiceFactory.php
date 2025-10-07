<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 100, 5000);
        
        return [
            'payment_id' => Payment::factory(),
            'invoice_number' => 'INV-' . $this->faker->unique()->numerify('########'),
            'generated_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'total_amount' => $amount,
        ];
    }
}
