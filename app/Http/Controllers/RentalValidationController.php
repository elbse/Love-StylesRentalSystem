<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rental;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class RentalValidationController extends Controller
{
    /**
     * Validate if customer can rent a new item
     */
    public static function canCustomerRent(Customer $customer)
    {
        // Check if customer has any overdue rentals
        if ($customer->hasOverdueRentals()) {
            $overdueRentals = $customer->getOverdueRentals();
            $overdueItems = $overdueRentals->map(function($reservation) {
                return $reservation->rental->reservation->item->name ?? 'Unknown Item';
            })->implode(', ');
            
            return [
                'can_rent' => false,
                'reason' => 'Customer has overdue rentals',
                'overdue_items' => $overdueItems,
                'overdue_count' => $overdueRentals->count(),
                'message' => "Customer cannot rent new items. They have {$overdueRentals->count()} overdue rental(s): {$overdueItems}. Please return overdue items first."
            ];
        }

        return [
            'can_rent' => true,
            'reason' => 'No overdue rentals found',
            'message' => 'Customer is eligible to rent new items.'
        ];
    }

    /**
     * Get customer's rental eligibility status
     */
    public function checkEligibility(Request $request)
    {
        $customerId = $request->get('customer_id');
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json([
                'can_rent' => false,
                'reason' => 'Customer not found',
                'message' => 'Customer does not exist.'
            ], 404);
        }

        return response()->json($this->canCustomerRent($customer));
    }
}
