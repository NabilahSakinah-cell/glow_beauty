<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        // 1. Ambil ID user yang login
        $userId = Auth::id();

        // 2. Ambil data pesanan (ganti 'pesanan' dengan nama tabelmu jika berbeda)
        $order = DB::table('pesanan')
                    ->where('user_id', $userId)
                    ->latest()
                    ->first();

        // 3. Kirim datanya ke view 'dashboard'
        return view('dashboard', compact('order'));
    }
}