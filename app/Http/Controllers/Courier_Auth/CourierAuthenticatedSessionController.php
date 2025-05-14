<?php

namespace App\Http\Controllers\Courier_Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CourierLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CourierAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('courier-auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(CourierLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('courier')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/courier/login');
    }
}
