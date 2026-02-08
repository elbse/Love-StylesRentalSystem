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
     * 
     * This seeder enforces the business rule: Customers with overdue rentals cannot rent additional items.
     * Rentals are created chronologically, and once a customer gets an overdue rental, no more rentals are created.
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
            $maxRentals = rand(1, 5);
            
            // Randomly decide if this customer will have an overdue rental
            $willHaveOverdue = (rand(1, 10) <= 2); // 20% chance of having an overdue rental
            
            // Create rentals chronologically (older rentals first)
            for ($rentalIndex = 0; $rentalIndex < $maxRentals; $rentalIndex++) {
                $inventory = $inventories->random();
                
                // Create reservation with chronological dates (older rentals first)
                $monthsAgo = $maxRentals - $rentalIndex; // More recent rentals for higher indices
                $reservationDate = Carbon::now()->subMonths($monthsAgo)->subDays(rand(0, 30));
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
                    
                    // Check if this should be an overdue rental
                    if ($willHaveOverdue && $rentalIndex === $maxRentals - 1) {
                        // This is the last rental and should be overdue
                        $rentalStatus = 'Overdue';
                        $penaltyFee = now()->diffInDays($dueDate) * 50;
                    } else {
                        // This is not the overdue rental, determine status
                        $statusRoll = rand(1, 10);
                        
                        if ($statusRoll <= 4) {
                            // 40% chance - Active (currently rented)
                            $returnDate = null; // Active rentals don't have return date yet
                            
                            // Check if rental should be overdue based on current date
                            if (now()->greaterThan($dueDate)) {
                                // This rental is overdue - no more rentals should be created after this
                                $rentalStatus = 'Overdue';
                                $penaltyFee = now()->diffInDays($dueDate) * 50;
                            } else {
                                $rentalStatus = 'Active';
                            }
                        } elseif ($statusRoll <= 8) {
                            // 40% chance - Returned (returned within 7 days)
                            $returnDate = $releasedDate->copy()->addDays(rand(1, 7));
                            $rentalStatus = 'Returned';
                        } else {
                            // 20% chance - Cancelled
                            $returnDate = $releasedDate->copy()->addDays(rand(1, 3)); // Cancelled rentals have a return date
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
                    
                    // Business Rule Enforcement: If this rental is overdue, stop creating more rentals
                    if ($rentalStatus === 'Overdue') {
                        break; // Customer cannot rent more items once they have an overdue rental
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