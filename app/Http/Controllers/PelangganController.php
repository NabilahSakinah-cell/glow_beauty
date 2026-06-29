<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
public function index()
{
    // Mengambil data langsung dari tabel, bypass model
    $data = DB::table('pesanan')->select('id_pelanggan')->get();
    
    // Log ini akan muncul di file storage/logs/laravel.log
    \Log::info('Daftar ID Pelanggan di database: ' . $data->toJson());

    // Coba ambil data ID 14 (Elma) secara paksa sebagai test
    $order = DB::table('pesanan')->where('id_pelanggan', 14)->first();
    
    $produk = DB::table('produk')->get();
    return view('dashboard', compact('order', 'produk'));
}
}