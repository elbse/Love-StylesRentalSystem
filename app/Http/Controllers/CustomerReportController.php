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

class CustomerReportController extends Controller
{
    /**
     * Display the customer report page
     */
    public function index()
    {
        // Get date range from request or default to last 12 months
        $startDate = request('start_date', Carbon::now()->subMonths(12)->startOfMonth());
        $endDate = request('end_date', Carbon::now()->endOfMonth());
        
        // Convert to Carbon instances if they're strings
        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate)->startOfMonth();
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate)->endOfMonth();
        }

        // Customer Statistics
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::whereHas('status', function($query) {
            $query->where('status_name', 'Active');
        })->count();
        $newCustomersThisMonth = Customer::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        // Rental Statistics
        $totalRentals = Rental::count();
        
        // Debug: Let's check what statuses actually exist
        $rentalStatuses = Rental::with('status')->get()->groupBy('status.status_name');
        
        // Alternative approach: Direct query with join
        $activeRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Active')
            ->count();
        $returnedRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Returned')
            ->count();
        $overdueRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Overdue')
            ->count();

        // Revenue Statistics
        $totalRevenue = Payment::sum('amount');
        $monthlyRevenue = Payment::whereBetween('payment_date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->sum('amount');
        $averageRentalValue = $totalRentals > 0 ? $totalRevenue / $totalRentals : 0;

        // Monthly data for charts (last 12 months)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $monthlyData[] = [
                'month' => $month->format('M Y'),
                'customers' => Customer::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                'rentals' => Rental::whereBetween('released_date', [$monthStart, $monthEnd])->count(),
                'revenue' => Payment::whereBetween('payment_date', [$monthStart, $monthEnd])->sum('amount'),
                'reservations' => Reservation::whereBetween('reservation_date', [$monthStart, $monthEnd])->count(),
            ];
        }

        // Top customers by revenue
        $topCustomers = Customer::with(['reservations.rental.payments'])
            ->get()
            ->map(function($customer) {
                $totalSpent = $customer->reservations
                    ->filter(function($reservation) {
                        return $reservation->rental !== null;
                    })
                    ->map(function($reservation) {
                        return $reservation->rental->payments->sum('amount');
                    })
                    ->sum();
                
                return [
                    'customer' => $customer,
                    'total_spent' => $totalSpent,
                    'rental_count' => $customer->reservations->count()
                ];
            })
            ->sortByDesc('total_spent')
            ->take(10);

        // Rental status distribution
        $rentalStatusData = $rentalStatuses->map(function($rentals, $status) {
            return [
                'status' => $status,
                'count' => $rentals->count(),
                'percentage' => 0 // Will be calculated in view
            ];
        });

        // Calculate percentages
        $totalRentalsForPercentage = $rentalStatusData->sum('count');
        $rentalStatusData = $rentalStatusData->map(function($item) use ($totalRentalsForPercentage) {
            $item['percentage'] = $totalRentalsForPercentage > 0 ? 
                round(($item['count'] / $totalRentalsForPercentage) * 100, 1) : 0;
            return $item;
        });

        // Customer status distribution
        $customerStatusData = Customer::with('status')
            ->get()
            ->groupBy('status.status_name')
            ->map(function($customers, $status) {
                return [
                    'status' => $status,
                    'count' => $customers->count(),
                    'percentage' => 0 // Will be calculated in view
                ];
            });

        // Overdue rentals with customer details
        $overdueRentalsCollection = Rental::with(['reservation.customer', 'reservation.item', 'status'])
            ->whereHas('status', function($query) {
                $query->where('status_name', 'Overdue');
            })
            ->orderBy('due_date', 'asc')
            ->get();

        // Calculate percentages for customer status
        $totalCustomersForPercentage = $customerStatusData->sum('count');
        $customerStatusData = $customerStatusData->map(function($item) use ($totalCustomersForPercentage) {
            $item['percentage'] = $totalCustomersForPercentage > 0 ? 
                round(($item['count'] / $totalCustomersForPercentage) * 100, 1) : 0;
            return $item;
        });

        // Inventory statistics
        $totalItems = Inventory::count();
        $availableItems = Inventory::whereHas('status', function($query) {
            $query->where('status_name', 'Available');
        })->count();
        $rentedItems = Inventory::whereHas('status', function($query) {
            $query->where('status_name', 'Rented');
        })->count();

        return view('customers.reports.index', compact(
            'totalCustomers',
            'activeCustomers', 
            'newCustomersThisMonth',
            'totalRentals',
            'activeRentals',
            'returnedRentals',
            'overdueRentals',
            'overdueRentalsCollection',
            'totalRevenue',
            'monthlyRevenue',
            'averageRentalValue',
            'monthlyData',
            'topCustomers',
            'rentalStatusData',
            'customerStatusData',
            'totalItems',
            'availableItems',
            'rentedItems',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export comprehensive customer report data to CSV
     */
    public function exportCsv(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->subMonths(12)->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());
        
        // Convert to Carbon instances if they're strings
        if (is_string($startDate)) {
            $startDate = Carbon::parse($startDate)->startOfMonth();
        }
        if (is_string($endDate)) {
            $endDate = Carbon::parse($endDate)->endOfMonth();
        }

        // Get all data for comprehensive report
        $customers = Customer::with(['status', 'reservations.rental.payments', 'reservations.rental.status'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Get summary statistics
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::whereHas('status', function($query) {
            $query->where('status_name', 'Active');
        })->count();
        $totalRentals = Rental::count();
        $activeRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Active')
            ->count();
        $totalRevenue = Payment::sum('amount');

        $filename = 'comprehensive_customer_report_' . Carbon::now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($customers, $totalCustomers, $activeCustomers, $totalRentals, $activeRentals, $totalRevenue, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            // Report Summary Section
            fputcsv($file, ['COMPREHENSIVE CUSTOMER REPORT']);
            fputcsv($file, ['Generated on:', Carbon::now()->format('Y-m-d H:i:s')]);
            fputcsv($file, ['Report Period:', $startDate->format('Y-m-d') . ' to ' . $endDate->format('Y-m-d')]);
            fputcsv($file, []);
            
            // Summary Statistics
            fputcsv($file, ['SUMMARY STATISTICS']);
            fputcsv($file, ['Total Customers', $totalCustomers]);
            fputcsv($file, ['Active Customers', $activeCustomers]);
            fputcsv($file, ['Total Rentals', $totalRentals]);
            fputcsv($file, ['Active Rentals', $activeRentals]);
            fputcsv($file, ['Total Revenue', '₱' . number_format($totalRevenue, 2)]);
            fputcsv($file, []);
            
            // Customer Details Section
            fputcsv($file, ['CUSTOMER DETAILS']);
            fputcsv($file, [
                'Customer ID',
                'Full Name',
                'Email',
                'Contact Number',
                'Address',
                'Status',
                'Registration Date',
                'Total Rentals',
                'Total Spent',
                'Last Rental Date',
                'Size',
                'Height',
                'Chest',
                'Waist',
                'Hips'
            ]);

            // Customer Data
            foreach ($customers as $customer) {
                $totalSpent = $customer->reservations
                    ->filter(function($reservation) {
                        return $reservation->rental !== null;
                    })
                    ->map(function($reservation) {
                        return $reservation->rental->payments->sum('amount');
                    })
                    ->sum();
                
                $lastRentalDate = $customer->reservations
                    ->filter(function($reservation) {
                        return $reservation->rental !== null;
                    })
                    ->map(function($reservation) {
                        return $reservation->rental->released_date;
                    })
                    ->max();
                
                $measurements = is_array($customer->measurement) ? $customer->measurement : 
                    (is_string($customer->measurement) ? json_decode($customer->measurement, true) : []);

                fputcsv($file, [
                    $customer->customer_id,
                    $customer->full_name,
                    $customer->email,
                    $customer->contact_number,
                    $customer->address,
                    $customer->status->status_name ?? 'Unknown',
                    $customer->created_at->format('Y-m-d'),
                    $customer->reservations->count(),
                    number_format($totalSpent, 2),
                    $lastRentalDate ? $lastRentalDate->format('Y-m-d') : 'Never',
                    $measurements['size'] ?? '',
                    $measurements['height'] ?? '',
                    $measurements['chest'] ?? '',
                    $measurements['waist'] ?? '',
                    $measurements['hips'] ?? ''
                ]);
            }

            fputcsv($file, []);
            
            // Rental History Section
            fputcsv($file, ['RENTAL HISTORY DETAILS']);
            fputcsv($file, [
                'Rental ID',
                'Customer Name',
                'Item Name',
                'Released Date',
                'Due Date',
                'Return Date',
                'Status',
                'Total Payments',
                'Penalty Fee',
                'Days Rented'
            ]);

            // Rental History Data
            $rentals = Rental::with(['reservation.customer', 'reservation.item', 'status', 'payments'])
                ->whereBetween('released_date', [$startDate, $endDate])
                ->get();

            foreach ($rentals as $rental) {
                $totalPayments = $rental->payments->sum('amount');
                $daysRented = $rental->return_date ? 
                    $rental->released_date->diffInDays($rental->return_date) : 
                    $rental->released_date->diffInDays(now());

                fputcsv($file, [
                    $rental->rental_id,
                    $rental->reservation->customer->full_name ?? 'Unknown',
                    $rental->reservation->item->name ?? 'Unknown Item',
                    $rental->released_date->format('Y-m-d'),
                    $rental->due_date->format('Y-m-d'),
                    $rental->return_date ? $rental->return_date->format('Y-m-d') : 'Not Returned',
                    $rental->status->status_name ?? 'Unknown',
                    number_format($totalPayments, 2),
                    number_format($rental->penalty_fee, 2),
                    $daysRented
                ]);
            }

            fputcsv($file, []);
            
            // Payment Details Section
            fputcsv($file, ['PAYMENT DETAILS']);
            fputcsv($file, [
                'Payment ID',
                'Customer Name',
                'Rental ID',
                'Amount',
                'Payment Type',
                'Payment Method',
                'Payment Date',
                'Status',
                'Invoice Number'
            ]);

            // Payment Data
            $payments = Payment::with(['rental.reservation.customer', 'rental.reservation', 'status', 'invoice'])
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->get();

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->payment_id,
                    $payment->rental->reservation->customer->full_name ?? 'Unknown',
                    $payment->rental_id,
                    number_format($payment->amount, 2),
                    $payment->payment_type,
                    $payment->payment_method,
                    $payment->payment_date->format('Y-m-d'),
                    $payment->status->status_name ?? 'Unknown',
                    $payment->invoice->invoice_number ?? 'N/A'
                ]);
            }

            fputcsv($file, []);
            
            // Monthly Summary Section
            fputcsv($file, ['MONTHLY SUMMARY (Last 12 Months)']);
            fputcsv($file, ['Month', 'New Customers', 'New Rentals', 'Revenue', 'New Reservations']);

            for ($i = 11; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthStart = $month->copy()->startOfMonth();
                $monthEnd = $month->copy()->endOfMonth();
                
                $monthlyCustomers = Customer::whereBetween('created_at', [$monthStart, $monthEnd])->count();
                $monthlyRentals = Rental::whereBetween('released_date', [$monthStart, $monthEnd])->count();
                $monthlyRevenue = Payment::whereBetween('payment_date', [$monthStart, $monthEnd])->sum('amount');
                $monthlyReservations = Reservation::whereBetween('reservation_date', [$monthStart, $monthEnd])->count();

                fputcsv($file, [
                    $month->format('M Y'),
                    $monthlyCustomers,
                    $monthlyRentals,
                    number_format($monthlyRevenue, 2),
                    $monthlyReservations
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}