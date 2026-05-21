<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// TAMBAHAN: Import class rute bawaan Laravel
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ------------------------------------------------------------------
        // TAMBAHAN: Memaksa rute bawaan Laravel 11 dialihkan ke katalog kamu
        // ------------------------------------------------------------------
        RedirectIfAuthenticated::redirectUsing(fn () => route('pelanggan.dashboard', absolute: false));
        // ------------------------------------------------------------------
    }
}