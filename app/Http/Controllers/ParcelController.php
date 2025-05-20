<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcel;
use App\Models\ParcelItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Branch;
use App\Models\Courier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    public function index()
    {

        if (Auth::guard('admin')->check()) {
            // Admin sees all parcels
            $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])->get();

            return view('admin.parcels.index', compact('parcels'));
        } elseif (Auth::guard('courier')->check()) {

            // Courier sees only their assigned parcels
            $courier = Auth::guard('courier')->user();
            $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])
                ->where('courier_id', $courier->id)->get();
            return view('courier.parcels.index', compact('parcels'));
        } elseif (Auth::guard('user')->check()) {


            // Hotel user sees only their parcels
            $hotelUser = Auth::guard('user')->user();
            $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])
                ->where('hotel_id', $hotelUser->id)->get();
            return view('parcels.index', compact('parcels', 'hotelUser'));
        } else {
            return redirect()->route('login'); // Unauthorized
        }
    }






    public function show($id)
    {
        $parcel = Parcel::with('items')->findOrFail($id);

        if (Auth::guard('user')->check()) {
            return view('parcels.index', compact('parcels', 'hotelUser'));
        } elseif (Auth::guard('courier')->check()) {
            return view('courier.parcels.show', compact('parcels'));
        } elseif (Auth::guard('admin')->check()) {
            return view('admin.parcels.show', compact('parcels'));
        } else {
        }
    }


    public function create()
    {
        $hotels = User::where('status', '1')->get();
        $branches = Branch::where('status', '1')->get();
        $couriers = Courier::where('status', '1')->get();

        if (Auth::guard('user')->check()) {
        } elseif (Auth::guard('courier')->check()) {


            $products =  Product::where('status', '1')->get();
            $courier = Courier::where('id', Auth::guard('courier')->user()->id)->get()->first();
            $branch = Branch::where('id', $courier->first()->branch_id)->get()->first();
            $parcels  =  Parcel::where('courier_id', Auth::guard('courier')->user()->id)->get();
            $hotels = User::where('status', '1')->get();
            return view('courier.parcels.create', compact('parcels', 'hotels', 'branch', 'courier', 'products'));
        } elseif (Auth::guard('admin')->check()) {

            return view('admin.parcels.create', compact('hotels', 'branches', 'couriers'));
        } else {
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'courier_id' => 'required|exists:couriers,id',
            'status' => 'required|string',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $parcel = Parcel::create([
                'hotel_id' => $request->hotel_id,
                'branch_id' => $request->branch_id,
                'to_branch_id' => $request->branch_id,
                'courier_id' => $request->courier_id,
                'sender_name' => '',
                'sender_address' => '',
                'sender_contact' => '',
                'recipient_name' => '',
                'recipient_address' => '',
                'recipient_contact' => '',
                'status' => $request->status,
                'type' => 'standard',
                'product_ids' => json_encode(array_column($request->products, 'id')),
                'product_quantities' => json_encode(array_column($request->products, 'quantity')),
            ]);

            foreach ($request->products as $product) {
                if (!isset($product['id']) || !isset($product['quantity'])) {
                    continue; // Skip if any required field is missing
                }

                $productModel = Product::find($product['id']);

                ParcelItem::create([
                    'parcel_id' => $parcel->id,
                    'product_id' => $product['id'], // This must exist
                    'quantity' => $product['quantity'],
                    'weight' => 0,
                    'height' => 0,
                    'length' => 0,
                    'width' => 0,
                    'price' => $productModel->price ?? 0,
                ]);
            }


            DB::commit();

            if (Auth::guard('user')->check()) {
            } elseif (Auth::guard('courier')->check()) {


                $courier = Auth::guard('courier')->user();
                $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])
                    ->where('courier_id', $courier->id)
                    ->latest()->get();
                return redirect()->route('courier.parcels.index', compact('parcels'));
            } elseif (Auth::guard('admin')->check()) {
                $parcels = Parcel::with(['hotel', 'branch', 'courier', 'items.product'])->get();

                return redirect()->route('admin.parcels.index', compact('parcels'));
            } else {
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $parcel = Parcel::with('items.product.category')->findOrFail($id);
        $hotels = User::where('status', '1')->get();
        $branches = Branch::where('status', '1')->get();
        $couriers = Courier::where('status', '1')->get();

        if (Auth::guard('user')->check()) {
        } elseif (Auth::guard('courier')->check()) {


            return view('admin.parcels.edit', compact('parcel', 'hotels', 'branches', 'couriers'));
        } elseif (Auth::guard('admin')->check()) {




            return view('admin.parcels.edit', compact('parcel', 'hotels', 'branches', 'couriers'));
        } else {
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'courier_id' => 'required|exists:couriers,id',
            'status' => 'required|string',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $parcel = Parcel::findOrFail($id);

            $parcel->update([
                'hotel_id' => $request->hotel_id,
                'branch_id' => $request->branch_id,
                'to_branch_id' => $request->branch_id,
                'courier_id' => $request->courier_id,
                'type' => 'standard',
                'status' => $request->status,

                'product_ids' => json_encode(array_column($request->products, 'id')),
                'product_quantities' => json_encode(array_column($request->products, 'quantity')),
            ]);

            $parcel->items()->delete();

            foreach ($request->products as $product) {
                $productModel = Product::find($product['id']);
                ParcelItem::create([
                    'parcel_id' => $parcel->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'weight' => 0,
                    'height' => 0,
                    'length' => 0,
                    'width' => 0,
                    'price' => $productModel->price ?? 0,
                ]);
            }

            DB::commit();

            if (Auth::guard('user')->check()) {
            } elseif (Auth::guard('courier')->check()) {
                return redirect()->to('courier/parcels')->withSuccess('Parcel saved successfully!');
            } elseif (Auth::guard('admin')->check()) {
                return redirect()->to('admin/parcels')->withSuccess('Parcel saved successfully!');
            } else {
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $parcel = Parcel::findOrFail($id);
            $parcel->items()->delete();
            $parcel->update([
                'status' => 'canceled'
            ]);
            return redirect()->route('admin.parcels.index')->with(['success' => true, 'message' => 'Parcel Canceled  successfully']);
        } catch (\Exception $e) {
            return redirect()->route('admin.parcels.index')->with(['success' => true, 'message' => $e->getMessage()]);
        }
    }
}
