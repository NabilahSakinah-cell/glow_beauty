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
        $cek_pelanggan = DB::table('pelanggan')->count();
        if ($cek_pelanggan == 0) {
            $total_pelanggan = DB::table('pesanan')->distinct('id_pelanggan')->count('id_pelanggan');
        } else {
            $total_pelanggan = $cek_pelanggan;
        }

        // 2. Query Top Selling Products
        $top_products = DB::table('detail_pesanan') // Sesuaikan dengan nama tabel detail/item pesananmu
        ->join('pesanan', 'detail_pesanan.id_pesanan', '=', 'pesanan.id_pesanan')
        ->join('produk', 'detail_pesanan.id_produk', '=', 'produk.id_produk') // Sesuaikan nama kolom ID produk
        ->where('pesanan.status', 'selesai')
        ->select('produk.nama_produk', DB::raw('SUM(detail_pesanan.jumlah) as total_terjual')) // Sesuaikan kolom jumlah/quantity
        ->groupBy('produk.id_produk', 'produk.nama_produk')
        ->orderBy('total_terjual', 'desc')
        ->take(3) // Ambil 3 produk teratas
        ->get();

        // 3. 📊 QUERY DATA GRAFIK (Disinkronkan: Hanya pesanan yang berstatus 'selesai')
      $all_sales = DB::table('pesanan')->get();

        $bulanan_omzet = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($all_sales as $data) {
            // Ambil status dan ubah ke huruf kecil untuk dicocokkan
            $status_pesanan = isset($data->status) ? strtolower(trim($data->status)) : '';
            
            if ($status_pesanan === 'selesai') {
                // Ambil nilai timestamp angka panjang dari database kamu
                $timestamp = $data->tanggal_pesanan ?? $data->tanggal ?? null;
                
                if (!empty($timestamp)) {
                    // Paksa ubah angka Unix Timestamp menjadi nomor bulan murni (1-12)
                    $bulan_angka = (int)date('n', $timestamp); 
                    
                    $indeksBulan = $bulan_angka - 1; // Array mulai dari index 0 (Januari = 0)
                    if ($indeksBulan >= 0 && $indeksBulan < 12) {
                        $bulanan_omzet[$indeksBulan] += (int)$data->total_harga;
                    }
                }
            }
        }

        // Simpan dalam format JSON murni untuk dilempar ke Javascript
        $bulanan_omzet_json = json_encode(array_values($bulanan_omzet));

        // 4. 💰 HITUNG OMZET (Menggunakan cara yang sukses terhubung)
        $omzet_bulan_ini = DB::table('pesanan')
            ->where('status', 'selesai')
            ->sum('total_harga');

        // 5. Mengirim semua variabel ke tampilan dashboard
        return view('owner.dashboard', compact(
            'total_produk', 
            'total_pesanan', 
            'total_pelanggan',
            'top_products',
            'bulanan_omzet_json',
            'omzet_bulan_ini' 
        ));
    }

    public function pesanan()
    {
        // Pastikan owner sudah login
        if (!session('owner_logged_in')) {
            return redirect('/login-owner'); 
        }

        // Ambil data semua pesanan dari database
        $semua_pesanan = DB::table('pesanan')
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        // Kirim data ke halaman khusus pesanan owner
        return view('owner.pesanan', compact('semua_pesanan'));
    }
    public function pelanggan()
    {
        // 1. Pastikan owner sudah login terlebih dahulu
        if (!session('owner_logged_in')) {
            return redirect('/login-owner'); 
        }

        // 2. Cek apakah ada data mandiri di tabel pelanggan
        $cek_pelanggan = DB::table('pelanggan')->count();
        
        if ($cek_pelanggan == 0) {
            // Opsi Paling Aman & Bagus: Grouping ID Pelanggan dari tabel pesanan
            // Menggunakan MAX() untuk menghindari error 'SQL Strict Mode' pada database
            $daftar_pelanggan = DB::table('pesanan')
                ->select(
                    'id_pelanggan', 
                    DB::raw('MAX(alamat) as alamat'), 
                    DB::raw('MAX(no_telepon) as no_telepon'),
                    DB::raw('MAX(tanggal_pesanan) as transaksi_terakhir')
                )
                ->groupBy('id_pelanggan')
                ->orderBy('transaksi_terakhir', 'desc')
                ->get();
        } else {
            // Jika suatu saat tabel pelanggan sudah memiliki data sendiri, ambil langsung dari sana
            $daftar_pelanggan = DB::table('pelanggan')->get();
        }

        // 3. Kirim data yang sudah bersih dan unik ke halaman pelanggan owner
        return view('owner.pelanggan', compact('daftar_pelanggan'));
    }

    public function produkIndex()
    {
        // Pastikan owner sudah login
        if (!session('owner_logged_in')) {
            return redirect('/login-owner'); 
        }

        // Ambil semua produk
        $produk = DB::table('produk')->get();
        
        // Kirim ke view owner.produk.index
        return view('owner.produk.index', compact('produk'));
    }

    public function pesananIndex()
    {
        // Pastikan owner sudah login
        if (!session('owner_logged_in')) {
            return redirect('/login-owner'); 
        }

        // Ambil semua pesanan (menggunakan fungsi yang sudah Anda buat sebelumnya)
        $semua_pesanan = DB::table('pesanan')
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('owner.pesanan', compact('semua_pesanan'));
    }
}