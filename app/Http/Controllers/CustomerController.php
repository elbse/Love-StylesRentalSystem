<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Rental;
use App\Models\RentalStatus;
use App\Models\ReservationStatus;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $requestedPerPage = (int) request('per_page');
        $perPage = in_array($requestedPerPage, [5, 10, 15, 25], true) ? $requestedPerPage : 10;

        $filters = [
            'q' => request('q'),
            'status' => request('status'),
            'email' => request('email'),
            'contact' => request('contact'),
            'name' => request('name'),
        ];

        $customer = Customer::query()
            ->with(['status'])
            ->filter($filters)
            ->orderBy('customer_id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        // KPI Statistics for the dashboard
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::whereHas('status', function($query) {
            $query->where('status_name', 'Active');
        })->count();
        $newCustomersThisMonth = Customer::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ])->count();
        $totalRentals = Rental::count();
        $activeRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Active')
            ->count();
        $overdueRentals = Rental::join('rental_status', 'rentals.status_id', '=', 'rental_status.status_id')
            ->where('rental_status.status_name', 'Overdue')
            ->count();

        return view('customers.index', [
            'title' => 'Customer Management', 
            'perPage' => $perPage,
            'totalCustomers' => $totalCustomers,
            'activeCustomers' => $activeCustomers,
            'newCustomersThisMonth' => $newCustomersThisMonth,
            'totalRentals' => $totalRentals,
            'activeRentals' => $activeRentals,
            'overdueRentals' => $overdueRentals
        ], ["customers"=> $customer]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:20|regex:/^[+]?[0-9\s\(\)]*[0-9][0-9\s\(\)]*$/',
            // optional measurement fields
            'size' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:50',
            'bust' => 'nullable|string|max:50',
            'waist' => 'nullable|string|max:50',
            'hips' => 'nullable|string|max:50',
        ], [
            'contact_number.regex' => 'The contact number must contain only positive numbers. Negative numbers are not allowed.',
        ]);

        $measurement = [
            'size' => $validated['size'] ?? null,
            'height' => $validated['height'] ?? null,
            // map bust to chest for consistency with factory/listing
            'chest' => $validated['bust'] ?? null,
            'waist' => $validated['waist'] ?? null,
            'hips' => $validated['hips'] ?? null,
        ];

        // remove measurement form-only fields from $validated
        unset($validated['size'], $validated['height'], $validated['bust'], $validated['waist'], $validated['hips']);

        // Ensure a valid status_id exists
        $statusId = \App\Models\CustomerStatus::query()->value('status_id');
        if (!$statusId) {
            $statusId = \App\Models\CustomerStatus::query()->create([
                'status_name' => 'Active',
                'reason' => 'Default',
            ])->status_id;
        }

        $data = array_merge($validated, [
            'measurement' => $measurement,
            'status_id' => $statusId,
        ]);

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();
        
        if (!$customer) {
            abort(404, 'Customer not found');
        }
        
        // Get rental history for this customer
        $rentals = Rental::with(['reservation.item', 'status', 'payments'])
            ->whereHas('reservation', function($query) use ($customer_id) {
                $query->where('customer_id', $customer_id);
            })
            ->orderBy('released_date', 'desc')
            ->get();
        
        // Calculate rental statistics
        $totalRentals = $rentals->count();
        $totalSpent = $rentals->sum(function($rental) {
            return $rental->payments->sum('amount');
        });
        $activeRentals = $rentals->where('status.status_name', 'Active')->count();
        
        return view('customers.show', compact('customer', 'rentals', 'totalRentals', 'totalSpent', 'activeRentals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->firstOrFail();
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->customer_id . ',customer_id',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:20|regex:/^[+]?[0-9\s\(\)]*[0-9][0-9\s\(\)]*$/',
            // optional measurement fields
            'size' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:50',
            'bust' => 'nullable|string|max:50',
            'waist' => 'nullable|string|max:50',
            'hips' => 'nullable|string|max:50',
        ], [
            'contact_number.regex' => 'The contact number must contain only positive numbers. Negative numbers are not allowed.',
        ]);

        $measurement = [
            'size' => $validated['size'] ?? ($customer->measurement['size'] ?? null),
            'height' => $validated['height'] ?? ($customer->measurement['height'] ?? null),
            'chest' => $validated['bust'] ?? ($customer->measurement['chest'] ?? null),
            'waist' => $validated['waist'] ?? ($customer->measurement['waist'] ?? null),
            'hips' => $validated['hips'] ?? ($customer->measurement['hips'] ?? null),
        ];

        unset($validated['size'], $validated['height'], $validated['bust'], $validated['waist'], $validated['hips']);

        $customer->update(array_merge($validated, [
            'measurement' => $measurement,
        ]));

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,customer_id',
        'password' => 'required',
    ]);

    if (!Hash::check($request->password, Auth::user()->password)) {
        return back()
            ->withErrors(['password' => 'Incorrect password.'])
            ->withInput([
                'customer_id' => $request->customer_id,
                'customer_name' => $request->customer_name,
            ]);
    }

    $customer = Customer::findOrFail($request->customer_id);
    $customer->delete();

    return redirect()->route('customers.index')->with('success', 'Customer deactivated successfully.');
}
    /**
     * Deactivate (soft delete) the specified customer.
     */

    public function deactivate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()
                ->withErrors(['password' => 'Incorrect password.'])
                ->withInput([
                    'customer_id' => $request->customer_id,
                    'customer_name' => $request->customer_name,
                ]);
        }

        $customer = Customer::find($request->customer_id);
        if ($customer) {
            $customer->status_id = $this->getOrCreateStatusId('Deactivated');
            $customer->save();
            return redirect()->route('customers.index')->with('success', 'Customer deactivated.');
        }
        return redirect()->route('customers.index')->with('error', 'Customer not found.');
    }

    /**
     * Reactivate (restore) the specified customer.
     */
    public function reactivate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()
                ->withErrors(['password' => 'Incorrect password.'])
                ->withInput([
                    'customer_id' => $request->customer_id,
                    'customer_name' => $request->customer_name,
                ]);
        }

        $customer = Customer::find($request->customer_id);
        if ($customer) {
            $customer->status_id = $this->getOrCreateStatusId('Active');
            $customer->save();
            return redirect()->route('customers.index')->with('success', 'Customer reactivated.');
        }
        return redirect()->route('customers.index')->with('error', 'Customer not found.');
    }

    /**
     * Ensure a CustomerStatus exists for the given name and return its id.
     */
    private function getOrCreateStatusId(string $statusName): int
    {
        $status = \App\Models\CustomerStatus::where('status_name', $statusName)->first();
        if (!$status) {
            $status = \App\Models\CustomerStatus::create([
                'status_name' => $statusName,
                'reason' => 'System generated',
            ]);
        }
        return $status->status_id;
    }

    
}
