<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestedPerPage = (int) request('per_page');
        $perPage = in_array($requestedPerPage, [5, 10, 15], true) ? $requestedPerPage : 5;

        $customer = Customer::orderBy('customer_id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('customers.index', ['title' => 'Customer Management', 'perPage' => $perPage], ["customers"=> $customer]);
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
            'contact_number' => 'required|string|max:20',
            // optional measurement fields
            'size' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:50',
            'bust' => 'nullable|string|max:50',
            'waist' => 'nullable|string|max:50',
            'hips' => 'nullable|string|max:50',
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
