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

        // Create 100 rental histories
        for ($i = 0; $i < 100; $i++) {
            // Select a customer without overdue rentals
            $availableCustomers = $customers->filter(function($customer) {
                return !$customer->hasOverdueRentals();
            });
            
            // If no customers without overdue rentals, select any customer
            if ($availableCustomers->isEmpty()) {
                $customer = $customers->random();
            } else {
                $customer = $availableCustomers->random();
            }
            
            $inventory = $inventories->random();
            $user = $users->random();
            
            // Create reservation with varied dates (some recent, some old)
            $isRecent = rand(1, 10) <= 3; // 30% chance of recent rental
            if ($isRecent) {
                $reservationDate = Carbon::now()->subDays(rand(1, 14));
                $startDate = $reservationDate->copy()->addDays(rand(1, 3));
            } else {
                $reservationDate = Carbon::now()->subMonths(rand(1, 6))->subDays(rand(0, 30));
                $startDate = $reservationDate->copy()->addDays(rand(1, 7));
            }
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
                
                // Determine rental status based on 7-day rental period
                $statusRoll = rand(1, 10);
                $rentalStatus = 'Active'; // Default to active
                
                if ($statusRoll <= 3) {
                    // 30% chance - Completed (returned within 7 days)
                    $returnDate = $releasedDate->copy()->addDays(rand(1, 7));
                    $rentalStatus = 'Completed';
                } elseif ($statusRoll <= 4) {
                    // 10% chance - Returned (returned exactly on due date)
                    $returnDate = $dueDate->copy();
                    $rentalStatus = 'Returned';
                } elseif ($statusRoll <= 5) {
                    // 10% chance - Cancelled
                    $rentalStatus = 'Cancelled';
                } else {
                    // 50% chance - Active or Overdue
                    if (now() > $dueDate) {
                        // Rental is overdue (past 7 days)
                        $rentalStatus = 'Overdue';
                        $penaltyFee = now()->diffInDays($dueDate) * 50; // 50 pesos per day overdue
                    } else {
                        // Rental is still active (within 7 days)
                        $rentalStatus = 'Active';
                    }
                }
                
                // Handle overdue returns (returned after 7 days)
                if ($statusRoll <= 2 && $returnDate && $returnDate > $dueDate) {
                    $rentalStatus = 'Overdue';
                    $penaltyFee = $returnDate->diffInDays($dueDate) * 50;
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

        $this->command->info('Rental history data created successfully!');
    }
}
