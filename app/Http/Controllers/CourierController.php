<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Branch;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the couriers.
     */
    public function index()
    {
        $couriers = Courier::with('branch')->get();

        // Check for any couriers without a branch and provide fallback logic if needed
        foreach ($couriers as $courier) {
            if (!$courier->branch) {
                $courier->branch_name = 'No Branch Assigned'; // Set a fallback value
            } else {
                $courier->branch_name = $courier->branch->name;
            }
        }

        return view('admin.couriers.index', compact('couriers'));
        }

    /**
     * Show the form for creating a new courier.
     */
    public function create()
    {
        $branches = Branch::all(); // Get all branches for selection
        return view('admin.couriers.create', compact('branches'));
    }

    /**
     * Store a newly created courier in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:couriers,name', // Validate name
            'email' => 'required|email|unique:couriers,email', // Ensure unique email
            'password' => 'required|string|min:8|confirmed', // Password confirmation and length validation
            'branch_id' => 'required|exists:branches,id', // Ensure valid branch_id
        ]);

        // Create new courier with validated data
        Courier::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('admin.couriers.index')->with('success', 'Courier created successfully.');
    }

    /**
     * Show the form for editing the specified courier.
     */
    public function edit(Courier $courier)
    {
        $branches = Branch::all(); // Get all branches for selection
        return view('admin.couriers.edit', compact('courier', 'branches'));
    }

    /**
     * Update the specified courier in the database.
     */
    public function update(Request $request, Courier $courier)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:couriers,name,' . $courier->id, // Validate name and ignore the current courier's name
            'email' => 'required|email|unique:couriers,email,' . $courier->id, // Ensure unique email, ignoring current courier
            'password' => 'nullable|string|min:8|confirmed', // Allow password update if provided
            'branch_id' => 'required|exists:branches,id', // Ensure valid branch_id
        ]);

        // Update the courier with validated data
        $courier->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $courier->password, // Hash password only if it's updated
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('admin.couriers.index')->with('success', 'Courier updated successfully.');
    }

    /**
     * Remove the specified courier from the database.
     */
    public function destroy(Courier $courier)
    {
        // Delete the courier
        $courier->delete();
        return redirect()->route('admin.couriers.index')->with('success', 'Courier deleted successfully.');
    }
}
