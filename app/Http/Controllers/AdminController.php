<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Ambil data admin dari database
        $admin = DB::table('admin')
            ->where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($admin) {
            session([
                'admin_logged_in' => true,
                'admin_nama' => $admin->nama,
                'admin_id' => $admin->id_admin
            ]);
            return redirect('/admin/dashboard');
        }

        // 💡 MODE BYPASS UNTUK TESTING:
        // Jika akun belum terdaftar di database, gunakan kredensial darurat ini agar bisa masuk dashboard
        if ($request->email == 'admin@gmail.com' && $request->password == 'admin123') {
            session([
                'admin_logged_in' => true,
                'admin_nama' => 'Glow Admin Toko',
                'admin_id' => 1
            ]);
            return redirect('/admin/dashboard');
        }

        // Jika salah, kembalikan dengan pesan error
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

    public function pesanan() {
        if (!session('admin_logged_in')) return redirect('/login-admin');
        return view('admin.pesanan'); 
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
}