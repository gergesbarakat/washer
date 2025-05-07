<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Http\Requests\StoreParcelRequest;
use App\Http\Requests\UpdateParcelRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courier;
use App\Models\ParcelItem;
use App\Models\Branch;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcels = Parcel::with(['hotel', 'courier', 'fromBranch', 'toBranch'])->get();
        return view('admin.parcels.index', compact('parcels'));
    }

    public function create()
    {
        $branches = Branch::all();
        $couriers = Courier::all();
        return view('admin.parcels.create', compact('branches', 'couriers'));
    }

    public function store(Request $request)
    {
        $parcel = Parcel::create($request->only([
            'user_id',
            'courier_id',
            'from_branch_id',
            'to_branch_id',
            'sender_name',
            'sender_address',
            'sender_contact',
            'recipient_name',
            'recipient_address',
            'recipient_contact',
            'type'
        ]));

        foreach ($request->input('items', []) as $item) {
            $parcel->items()->create($item);
        }

        return redirect()->route('admin.parcels.index');
    }

    public function edit(Parcel $parcel)
    {
        $branches = Branch::all();
        $couriers = Courier::all();
        $parcel->load('items');
        return view('admin.parcels.edit', compact('parcel', 'branches', 'couriers'));
    }

    public function update(Request $request, Parcel $parcel)
    {
        $parcel->update($request->only([
            'user_id',
            'courier_id',
            'from_branch_id',
            'to_branch_id',
            'sender_name',
            'sender_address',
            'sender_contact',
            'recipient_name',
            'recipient_address',
            'recipient_contact',
            'type'
        ]));

        $parcel->items()->delete();
        foreach ($request->input('items', []) as $item) {
            $parcel->items()->create($item);
        }

        return redirect()->route('admin.parcels.index');
    }
}
