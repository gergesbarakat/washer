<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        Branch::create($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        $branch->update($validated);

        return redirect()->route(route: 'admin.branches.index')->with('success', 'Branch updated successfully.');
    }
    public function destroy(Branch $branch)
    {
        // Delete the courier

        $branch->update(['status' => '0']);

        return redirect()->route('admin.branches.index')->with('success', 'branch has been deactivated instead of deleted.');
    }
    public function activate($id)
    {
        $hotel = Branch::findOrFail($id);
        $hotel->status = 1;
        $hotel->save();

        return redirect()->route('admin.branches.index')->with('success', 'Hotel activated successfully.');
    }
}
