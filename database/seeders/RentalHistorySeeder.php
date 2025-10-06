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

        // Create 50 rental histories
        for ($i = 0; $i < 50; $i++) {
            $customer = $customers->random();
            $inventory = $inventories->random();
            $user = $users->random();
            
            // Create reservation
            $reservationDate = Carbon::now()->subMonths(rand(1, 6))->subDays(rand(0, 30));
            $startDate = $reservationDate->copy()->addDays(rand(1, 7));
            $endDate = $startDate->copy()->addDays(rand(1, 14));
            
            $reservation = Reservation::create([
                'customer_id' => $customer->customer_id,
                'item_id' => $inventory->item_id,
                'reserved_by' => $user->user_id,
                'reservation_date' => $reservationDate,
                'status_id' => $reservationStatuses['Confirmed']->status_id,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            // Create rental (80% chance)
            if (rand(1, 10) <= 8) {
                $releasedDate = $startDate->copy()->addDays(rand(0, 2));
                $dueDate = $releasedDate->copy()->addDays(rand(3, 14));
                $returnDate = null;
                $penaltyFee = 0;
                
                // Determine if rental is completed (70% chance)
                if (rand(1, 10) <= 7) {
                    $returnDate = $dueDate->copy()->addDays(rand(-2, 5));
                    if ($returnDate > $dueDate) {
                        $penaltyFee = $returnDate->diffInDays($dueDate) * 50;
                    }
                }
                
                // Determine rental status
                $rentalStatus = 'Active';
                if ($returnDate) {
                    $rentalStatus = $penaltyFee > 0 ? 'Overdue' : 'Completed';
                } elseif (now() > $dueDate) {
                    $rentalStatus = 'Overdue';
                    $penaltyFee = now()->diffInDays($dueDate) * 50;
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
