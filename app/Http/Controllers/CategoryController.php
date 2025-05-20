<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));

        return redirect()->route('admin.categories.index')->with('status', 'Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'true',
        ]));

        return redirect()->route('admin.categories.index')->with('status', 'Edited Successfully');
    }
    public function destroy(Category $category)
    {
        // Delete the courier
        $category->update(['status' => '0']);
        return redirect()->route('admin.categories.index')->with('success', 'category has been deactivated  .');
    }
    public function activate($id)
    {
        $hotel = Category::findOrFail($id);
        $hotel->status = 1;
        $hotel->save();

        return redirect()->route('admin.categories.index')->with('success', 'Hotel activated successfully.');
    }
}
