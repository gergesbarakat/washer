<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourierUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Courier;
use App\Models\Branch;

class CourierProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function create()
    {
        $hotels = User::where('role', 'hotel')->get(); // fetch all hotels from users
        $branches = Branch::all();
        $couriers = Courier::all();

        return view('admin.parcels.create', [
            'hotels' => $hotels,
            'branches' => $branches,
            'couriers' => $couriers,
        ]);
    }
    public function edit(Request $request): View
    {
        return view('courier.profile.edit', [
            'user' => $request->user('courier'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(CourierUpdateRequest $request): RedirectResponse
    {
        $request->user('courier')->fill($request->validated());

        if ($request->user('courier')->isDirty('email')) {
            $request->user('courier')->email_verified_at = null;
        }

        $request->user('courier')->save();

        return Redirect::route('courier.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::guard('courier')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/courier');
    }
}
