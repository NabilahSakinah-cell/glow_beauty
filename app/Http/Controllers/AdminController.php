<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login(Request $request)
{
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cari di tabel 'admin'
        // Kita cek email DAN password langsung di database
        $admin = \Illuminate\Support\Facades\DB::table('admin')
                    ->where('email', $request->email)
                    ->where('password', $request->password) 
                    ->first();

        // 3. Cek apakah admin ditemukan
        //dd($admin);
        if ($admin) {
            
            // 4. Set Session
            session([
                'admin_logged_in' => true,
                'admin_nama' => $admin->nama,
                'admin_id' => $admin->id_admin // SESUAI GAMBAR: nama kolomnya 'id_admin'
            ]);

            return redirect('/admin/dashboard');
        }

        // Jika gagal, kembalikan pesan error
        return back()->withErrors(['email' => 'Email atau password Admin salah!']);
    }

    // 2. Fungsi Menampilkan Dashboard Admin
    public function index()
    {
        // Tolak akses jika belum login sebagai admin
        if (!session('admin_logged_in')) {
            return redirect('/login-admin');
        }
        return view('admin.dashboard');
    }

    // ==========================================
    // FUNGSI MENU HAK AKSES ADMIN
    // ==========================================

    public function produk() {
        if (!session('admin_logged_in')) {
            return redirect('/login-admin');
        }
        
        // Deteksi fleksibel: Membuka file create atau tambah-produk yang ada di foldermu
        try {
            return view('admin.produk.create');
        } catch (\Throwable $e) {
            try {
                return view('admin.produk.tambah-produk'); 
            } catch (\Throwable $e) {
                return view('admin.products.tambah-produk'); 
            }
        }
    }

    public function stok() {
        if (!session('admin_logged_in')) return redirect('/login-admin');
        return view('admin.stok'); 
    }

    public function pesanan(Request $request) {
    if (!session('admin_logged_in')) return redirect('/login-admin');

    // 1. Buat Query Dasar
    $query = DB::table('pesanan')
    ->leftJoin('users', 'pesanan.id_pelanggan', '=', 'users.id')
    ->select('pesanan.*', 'users.name as nama_pelanggan')
    ->orderBy('pesanan.id_pesanan', 'desc');

    // 2. Filter Pencarian (Search)
    if ($request->filled('search')) {
        $query->where('id_pesanan', 'like', '%' . $request->search . '%');
    }

    // 3. Filter Status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // 4. Filter Tanggal
    // Filter Tanggal
    if ($request->filled('tanggal')) {
        $tanggalInput = $request->tanggal;
        $tanggalTeks = date('d M Y', strtotime($tanggalInput));
        $awalHari = strtotime($tanggalInput . ' 00:00:00');
        $akhirHari = strtotime($tanggalInput . ' 23:59:59');

        $query->where(function($q) use ($tanggalInput, $tanggalTeks, $awalHari, $akhirHari) {
            $q->whereDate('pesanan.tanggal_pesanan', $tanggalInput)
              ->orWhere('pesanan.tanggal_pesanan', 'like', '%' . $tanggalTeks . '%')
              ->orWhereBetween('pesanan.tanggal_pesanan', [$awalHari, $akhirHari]);
        });
    }

    // 5. Eksekusi Query
    $pesanan = $query->get();

    // 6. Logika Export (Jika tombol Export ditekan)
    if ($request->has('export') && $request->export == 'true') {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Laporan_Pesanan.csv"
        ];
        
        $callback = function() use($pesanan) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Pesanan', 'Status', 'Total Harga', 'Tanggal']);
            foreach ($pesanan as $row) {
                fputcsv($file, [$row->id_pesanan, $row->status, $row->total_harga, $row->created_at]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

    // Statistik (Tetap sama)
    $stats = [
        'baru'    => DB::table('pesanan')->where('status', 'Pending')->count(),
        'proses'  => DB::table('pesanan')->where('status', 'Diproses')->count(),
        'dikirim' => DB::table('pesanan')->where('status', 'Dikirim')->count(),
        'selesai' => DB::table('pesanan')->where('status', 'Selesai')->count(),
    ];

    return view('admin.pesanan', compact('pesanan', 'stats'));
}

public function detail_pesanan($id)
{
    // Ambil data pesanan
    $pesanan = DB::table('pesanan')->where('id_pesanan', $id)->first();
    
    // Ambil detail items
    $items = DB::table('detail_pesanan')
                ->where('id_pesanan', $id)
                ->get();

    if (!$pesanan) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    return view('admin.detail_pesanan', compact('pesanan', 'items'));
}

public function edit_pesanan($id)
{
    // 1. Ambil data pesanan utama
    $pesanan = DB::table('pesanan')->where('id_pesanan', $id)->first();

    // 2. Ambil detail items (asumsi tabelnya 'detail_pesanan')
    $items = DB::table('detail_pesanan')->where('id_pesanan', $id)->get();

    if (!$pesanan) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    // Kirim data pesanan dan items ke view
    return view('admin.edit_pesanan', compact('pesanan', 'items'));
}

public function update_pesanan(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
        'alamat' => 'required',
    ]);

    try {
        DB::table('pesanan')->where('id_pesanan', $id)->update([
            'status' => $request->status,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pesanan')->with('success', 'Status berhasil diupdate!');
    } catch (\Exception $e) {
        // Tambahkan ini untuk melihat errornya jika gagal
        return redirect()->back()->with('error', 'Gagal update: ' . $e->getMessage());
    }
}

    public function simpan_produk(Request $request) {
        // Validasi input yang mendukung nama kolom 'nama'/'nama_produk' dan 'foto'/'gambar'
        $request->validate([
            'nama'             => 'nullable|string|max:255',
            'nama_produk'      => 'nullable|string|max:255',
            'harga'            => 'required|numeric|min:0',
            'stok'             => 'nullable|numeric|min:0',
            'kategori'         => 'required|string',
            'deskripsi_produk' => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Standarisasi Nama Produk
        $nama_produk_final = $request->nama ?? $request->nama_produk ?? 'Kosmetik Glowing';

        // Proses upload file gambar/foto
        $nama_gambar = 'default.png';
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $nama_gambar);
        } elseif ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $nama_gambar);
        }

        // Simpan data langsung ke database dengan struktur kolom ganda (agar kebal error nama kolom database)
        try {
            DB::table('produk')->insert([
                'nama'             => $nama_produk_final,
                'nama_produk'      => $nama_produk_final,
                'harga'            => $request->harga,
                'stok'             => $request->stok ?? 10,
                'kategori'         => $request->kategori,
                'deskripsi_produk' => $request->deskripsi_produk ?? 'Produk kecantikan aman BPOM',
                'foto'             => $nama_gambar,
                'gambar'           => $nama_gambar, 
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        } catch (\Throwable $e) {
            // Jika nama tabelnya di phpMyAdmin adalah 'products'
            DB::table('products')->insert([
                'nama'             => $nama_produk_final,
                'nama_produk'      => $nama_produk_final,
                'harga'            => $request->harga,
                'stok'             => $request->stok ?? 10,
                'kategori'         => $request->kategori,
                'deskripsi_produk' => $request->deskripsi_produk ?? 'Produk kecantikan aman BPOM',
                'foto'             => $nama_gambar,
                'gambar'           => $nama_gambar, 
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Sip! Produk baru berhasil disimpan ke database. ✨');
    }

    public function daftar_produk() {
        try {
            $produk = DB::table('produk')->get();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->get();
        }
        return view('admin.produk.daftar-produk', compact('produk'));
    }

    public function edit_produk($id) {
        try {
            $produk = DB::table('produk')->where('id_produk', $id)->first() ?? DB::table('produk')->where('id', $id)->first();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->where('id', $id)->first();
        }
        return view('admin.produk.edit-produk', compact('produk'));
    }

    public function update_produk(Request $request, $id) {
        $data = [
            'nama' => $request->nama ?? $request->nama_produk,
            'nama_produk' => $request->nama ?? $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok ?? 10,
            'deskripsi_produk' => $request->deskripsi_produk,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $nama_file);
            $data['gambar'] = $nama_file;
            $data['foto'] = $nama_file;
        } elseif ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $nama_file);
            $data['gambar'] = $nama_file;
            $data['foto'] = $nama_file;
        }

        try {
            DB::table('produk')->where('id_produk', $id)->orWhere('id', $id)->update($data);
        } catch (\Throwable $e) {
            DB::table('products')->where('id', $id)->update($data);
        }
        
        return redirect('/admin/produk/daftar');
    }

    public function hapus_produk($id) {
        try {
            DB::table('produk')->where('id_produk', $id)->orWhere('id', $id)->delete();
        } catch (\Throwable $e) {
            DB::table('products')->where('id', $id)->delete();
        }
        return redirect('/admin/produk/daftar');
    }

    public function export()
{
    // 1. Ambil data pesanan beserta nama pelanggan (sama seperti fungsi index)
    $pesanan = DB::table('pesanan')
        ->leftJoin('users', 'pesanan.id_pelanggan', '=', 'users.id')
        ->select('pesanan.*', 'users.name as nama_pelanggan')
        ->orderBy('pesanan.id_pesanan', 'desc')
        ->get();

    // 2. Buat nama file otomatis sesuai waktu download
    $filename = "Laporan_Pesanan_" . date('Y-m-d_H-i-s') . ".csv";

    // 3. Buka "pipa" untuk mengalirkan data
    $handle = fopen('php://output', 'w');

    // 4. Buat Baris Pertama (Judul Kolom)
    // Sesuaikan dengan judul di tabel layar Anda
    fputcsv($handle, ['Nota', 'Nama Pelanggan', 'Tanggal Pesanan', 'Total Bayar', 'Status'], ';');

    // 5. Masukkan isi datanya baris demi baris
    foreach ($pesanan as $row) {
        
        // Cek jika tanggal berupa timestamp (angka) atau string biasa
        // Jika di database berupa timestamp, biarkan seperti ini. Jika tidak, sesuaikan.
        $tanggal = is_numeric($row->tanggal_pesanan) 
                    ? date('d M Y', $row->tanggal_pesanan) 
                    : $row->tanggal_pesanan;

        fputcsv($handle, [
            '#TRX' . $row->id_pesanan,
            $row->nama_pelanggan ?? '-',
            $tanggal,
            $row->total_harga ?? 0,
            $row->status
        ], ';');
    }

    fputcsv($handle, ['', '', '', '', ''], ';'); 

    $totalSemua = $pesanan->sum('total_harga'); 

    fputcsv($handle, ['', '', 'TOTAL PENDAPATAN:', $totalSemua, ''], ';');

    fclose($handle);

    // 6. Kirim file ke browser untuk didownload
    return response()->stream(function() use ($handle) {}, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);
    }
}