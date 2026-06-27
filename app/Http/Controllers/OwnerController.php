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

    // 2. Query Top Selling Products
    $top_products = DB::table('detail_pesanan')
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk') 
        ->select('produk.nama_produk', DB::raw('SUM(detail_pesanan.jumlah) as total_terjual'))
        ->groupBy('detail_pesanan.id_produk', 'produk.nama_produk')
        ->orderBy('total_terjual', 'desc')
        ->limit(3)
        ->get();

    // 3. ✨ QUERY DATA GRAFIK: Ambil omzet riil per bulan untuk tahun ini
    $sales_data = DB::table('pesanan')
        ->select(
            DB::raw('MONTH(tanggal_pesanan) as bulan'),
            DB::raw('SUM(total_harga) as total_omzet')
        )
        ->whereYear('tanggal_pesanan', date('Y')) // Mengambil data tahun berjalan (2026)
        ->groupBy(DB::raw('MONTH(tanggal_pesanan)'))
        ->orderBy('bulan', 'asc')
        ->pluck('total_omzet', 'bulan')
        ->toArray();

    // Petakan data ke dalam susunan 12 bulan (Jan - Des) agar urut dan bernilai 0 jika bulan tersebut belum ada transaksi
    $bulanan_omzet = [];
    for ($m = 1; $m <= 12; $m++) {
        $bulanan_omzet[] = $sales_data[$m] ?? 0; 
    }

    // 4. Kirim semua variabel ke file Blade
    return view('owner.dashboard', compact(
        'total_produk', 
        'total_pesanan', 
        'total_pelanggan',
        'top_products',
        'bulanan_omzet' // Dikirim ke blade untuk dibaca Chart.js
    ));
}
}