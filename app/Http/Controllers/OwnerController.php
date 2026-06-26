<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function login(Request $request)
    {
        // 1. Ambil HANYA baris pertama (data tunggal) dari tabel owner
        $owner = DB::table('owner')->first();

        // 2. Jaga-jaga jika tabel owner di database ternyata masih kosong
        if (!$owner) {
            return back()->withErrors(['email' => 'Sistem menolak: Data Owner belum diatur di Database!']);
        }

        // 3. Cocokkan email dan password yang diketik dengan data tunggal di database
        if ($request->email === $owner->email && $request->password === $owner->password) {
            
            // 4. Jika cocok, jalankan sesi login
            session([
                'owner_logged_in' => true, 
                'owner_nama' => $owner->nama,
                'owner_id' => $owner->id_owner
            ]);

            // 5. Arahkan masuk ke halaman dashboard owner
            return redirect('/owner'); 
        }

        // 6. Jika yang login mencoba memasukkan email/password yang berbeda dari baris pertama
        return back()->withErrors(['email' => 'Akses Ditolak! Anda bukan Owner resmi.']);
    }

    public function index()
{
    // Pengecekan keamanan session login
    if (!session('owner_logged_in')) {
        return redirect('/login-owner'); 
    }

    // 1. Hitung total data ringkasan widget
    $total_produk = DB::table('produk')->count();
    $total_pesanan = DB::table('pesanan')->count();
    $total_pelanggan = DB::table('pelanggan')->count();

    // 2. ✨ QUERY OTOMATIS TOP SELLING: Mengambil produk dengan akumulasi pesanan terbanyak
    // Kita lakukan Join antara tabel detail_pesanan dengan tabel produk
    $top_products = DB::table('detail_pesanan')
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk') 
        ->select('produk.nama_produk', DB::raw('SUM(detail_pesanan.jumlah) as total_terjual'))
        ->groupBy('detail_pesanan.id_produk', 'produk.nama_produk')
        ->orderBy('total_terjual', 'desc')
        ->limit(3) // Mengambil 3 produk teratas
        ->get();

    // 3. Kirim variabel $top_products ke file Blade
    return view('owner.dashboard', compact(
        'total_produk', 
        'total_pesanan', 
        'total_pelanggan',
        'top_products'
    ));
}
}