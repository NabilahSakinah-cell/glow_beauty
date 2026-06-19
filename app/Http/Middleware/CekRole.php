<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek aturan khusus untuk OWNER (Menggunakan session manual sesuai OwnerController)
        if (session('owner_logged_in') === true) {
            return $next($request); // Owner bebas masuk ke mana saja (termasuk halaman admin)
        }

        // 2. Cek aturan untuk ADMIN (Menggunakan Auth bawaan Laravel)
        if (Auth::check()) {
            $userRole = Auth::user()->role; // Mengambil 'admin' dari tabel users

            if (in_array($userRole, $roles)) {
                return $next($request);
            }
        }

        // 3. Jika tidak punya akses (Bukan Owner yang login, dan Bukan Admin yang sah)
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}