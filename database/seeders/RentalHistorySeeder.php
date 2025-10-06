<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Rental;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\RentalStatus;
use App\Models\ReservationStatus;
use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RentalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $customers = Customer::all();
        $inventories = Inventory::all();
        $users = User::all();
        
        if ($customers->isEmpty() || $inventories->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Please run customer, inventory, and user seeders first!');
            return;
        }

        // Get status IDs
        $rentalStatuses = RentalStatus::all()->keyBy('status_name');
        $reservationStatuses = ReservationStatus::all()->keyBy('status_name');
        $paymentStatuses = PaymentStatus::all()->keyBy('status_name');

        // Create realistic rental histories for each customer
        foreach ($customers as $customer) {
            $user = $users->random();
            
            // Determine how many rentals this customer should have (1-5 rentals)
            $rentalCount = rand(1, 5);
            $hasOverdue = false; // Track if customer already has overdue rental
            $overdueIndex = -1; // Track which rental will be overdue
            
            // Randomly decide which rental (if any) will be overdue
            if (rand(1, 10) <= 2) { // 20% chance of having an overdue rental
                $overdueIndex = rand(0, $rentalCount - 1);
            }
            
            for ($rentalIndex = 0; $rentalIndex < $rentalCount; $rentalIndex++) {
                $inventory = $inventories->random();
                
                // Create reservation with chronological dates
                $reservationDate = Carbon::now()->subMonths(rand(1, 6))->subDays(rand(0, 30));
                $startDate = $reservationDate->copy()->addDays(rand(1, 3));
                $endDate = $startDate->copy()->addDays(7); // Fixed 7-day rental period
                
                $reservation = Reservation::create([
                    'customer_id' => $customer->customer_id,
                    'item_id' => $inventory->item_id,
                    'reserved_by' => $user->user_id,
                    'reservation_date' => $reservationDate,
                    'status_id' => $reservationStatuses['Confirmed']->status_id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);

                // Create rental (90% chance)
                if (rand(1, 10) <= 9) {
                    $releasedDate = $startDate->copy()->addDays(rand(0, 2));
                    $dueDate = $releasedDate->copy()->addDays(7); // Fixed 7-day rental period
                    $returnDate = null;
                    $penaltyFee = 0;
                    
                    // Determine rental status with business logic
                    $rentalStatus = 'Active';
                    
                    // Check if this is the designated overdue rental
                    if ($rentalIndex === $overdueIndex) {
                        // This rental is designated to be overdue
                        $rentalStatus = 'Overdue';
                        $penaltyFee = now()->diffInDays($dueDate) * 50;
                        $hasOverdue = true; // Mark customer as having overdue
                        
                        // Ensure this is the last rental by breaking the loop
                        $rentalCount = $rentalIndex + 1;
                    } else {
                        // This is not the overdue rental, so it must be completed/returned
                        $statusRoll = rand(1, 10);
                        
                        if ($statusRoll <= 6) {
                            // 60% chance - Completed (returned within 7 days)
                            $returnDate = $releasedDate->copy()->addDays(rand(1, 7));
                            $rentalStatus = 'Completed';
                        } elseif ($statusRoll <= 8) {
                            // 20% chance - Returned (returned exactly on due date)
                            $returnDate = $dueDate->copy();
                            $rentalStatus = 'Returned';
                        } else {
                            // 20% chance - Cancelled
                            $rentalStatus = 'Cancelled';
                        }
                    }
                
                    $rentalData = [
                        'reservation_id' => $reservation->reservation_id,
                        'released_by' => $user->user_id,
                        'released_date' => $releasedDate,
                        'due_date' => $dueDate,
                        'status_id' => $rentalStatuses[$rentalStatus]->status_id,
                        'penalty_fee' => $penaltyFee,
                    ];
                    
                    if ($returnDate) {
                        $rentalData['return_date'] = $returnDate;
                    }
                    
                    $rental = Rental::create($rentalData);

                    // If this was the overdue rental, break the loop to prevent more rentals
                    if ($rentalIndex === $overdueIndex) {
                        break;
                    }

                    // Create payments (1-3 payments per rental)
                    $paymentCount = rand(1, 3);
                    $totalAmount = rand(500, 3000);
                    $remainingAmount = $totalAmount;
                    
                    for ($j = 0; $j < $paymentCount; $j++) {
                        $isLastPayment = ($j === $paymentCount - 1);
                        $amount = $isLastPayment ? $remainingAmount : rand(100, $remainingAmount - 100);
                        $remainingAmount -= $amount;
                        
                        $payment = Payment::create([
                            'rental_id' => $rental->rental_id,
                            'reservation_id' => $reservation->reservation_id,
                            'amount' => $amount,
                            'payment_type' => $j === 0 ? 'deposit' : 'rental_fee',
                            'payment_method' => ['cash', 'card', 'bank_transfer'][rand(0, 2)],
                            'payment_date' => $releasedDate->copy()->addDays(rand(0, 5)),
                            'processed_by' => $user->user_id,
                            'status_id' => $paymentStatuses['Completed']->status_id,
                        ]);

                        // Create invoice for each payment
                        Invoice::create([
                            'payment_id' => $payment->payment_id,
                            'invoice_number' => 'INV-' . str_pad($payment->payment_id, 8, '0', STR_PAD_LEFT),
                            'generated_date' => $payment->payment_date,
                            'total_amount' => $amount,
                        ]);
                    }
                } else {
                    // Reservation was cancelled
                    $reservation->update([
                        'status_id' => $reservationStatuses['Cancelled']->status_id
                    ]);
                }
            }
        }

        $this->command->info('Rental history data created successfully!');
    }
}
