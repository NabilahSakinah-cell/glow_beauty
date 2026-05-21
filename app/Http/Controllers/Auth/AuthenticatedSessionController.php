<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ------------------------------------------------------------------
        // TAMBAHAN: Jika rute 'pelanggan.dashboard' ada, langsung alihkan ke sana
        // ------------------------------------------------------------------
        if (\Illuminate\Support\Facades\Route::has('pelanggan.dashboard')) {
            return redirect()->intended(route('pelanggan.dashboard'));
        }
        
        // Alternatif tambahan jika kamu menggunakan URL manual tanpa nama rute
        return redirect()->intended('/pelanggan/dashboard');
        // ------------------------------------------------------------------

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}