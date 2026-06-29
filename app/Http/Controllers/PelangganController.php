<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
   public function index()
{
    $userId = Auth::id();

    // Mengambil pesanan terbaru yang BELUM selesai
    $order = DB::table('pesanan')
                ->where('id_pelanggan', $userId)
                ->where('status', '!=', 'Selesai') // Abaikan yang sudah selesai
                ->latest()
                ->first();
                
    // Jika tidak ada pesanan yang belum selesai, ambil yang paling terakhir (apapun statusnya)
    if (!$order) {
        $order = DB::table('pesanan')
                    ->where('id_pelanggan', $userId)
                    ->latest()
                    ->first();
    }

    return view('dashboard', compact('order'));
}
}