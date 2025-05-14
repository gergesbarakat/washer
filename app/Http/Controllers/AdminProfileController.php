<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Courier;
use App\Models\Branch;

class AdminProfileController extends Controller
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
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(AdminUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
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

        Auth::guard('user')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
