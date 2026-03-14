<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventories.index', [
            'title' => 'Inventory Management'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'size'       => 'required|string|max:50',
            'color'      => 'required|string|max:50',
            'rental_fee' => 'required|numeric|min:0',
            'status'     => 'required|in:available,reserved,out-of-stock',
            'condition'  => 'required|string|max:255',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($inventory->image && Storage::exists('public/images/' . $inventory->image)) {
                Storage::delete('public/images/' . $inventory->image);
            }
            $filename = $request->file('image')->store('public/images');
            $validated['image'] = basename($filename);
        }

        $inventory->update($validated);

        return back()->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
