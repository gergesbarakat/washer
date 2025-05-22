<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'user')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.products.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        Product::create([
            'user_id' => $request->user_id, // or any user ID if you're assigning manually
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.products.edit', compact('product', 'categories', 'users'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        $product->update([
            'user_id' => $request->user_id, // or keep old one
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => '0']);

        return redirect()->route('admin.products.index')->with('success', 'Product has been deactivated instead of deleted.');
    }

    public function show(Request $request)
    {
        $query = $request->get('q');
        $products = Product::with('category')->where('user_id', $request->user_id)
            ->where('name', 'like', "%$query%")
             ->get();
        return response()->json($products);
    }
    public function activate($id)
    {
        $hotel = Product::findOrFail($id);
        $hotel->status = 1;
        $hotel->save();

        return redirect()->route('admin.products.index')->with('success', 'product activated successfully.');
    }
    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::with('category')->where('user_id', $request->user_id)
            ->where('name', 'like', "%$query%")
             ->get();
        return response()->json($products);
    }
}
