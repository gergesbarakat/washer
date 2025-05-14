<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = User::all();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('admin.hotels.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'contact' => 'nullable|string|unique:users,contact',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function edit(User $hotel)
    {
        $branches = Branch::all();
        return view('admin.hotels.edit', compact('hotel', 'branches'));
    }

    public function update(Request $request, User $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $hotel->id,
            'email' => 'required|email|unique:users,email,' . $hotel->id,
            'password' => 'nullable|string|min:6|confirmed',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'contact' => 'nullable|string|unique:users,contact,' . $hotel->id,
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(User $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
