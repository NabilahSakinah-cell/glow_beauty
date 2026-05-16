<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login(Request $request)
    {
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
        // Cek apakah admin sudah login
        if (!session('admin_logged_in')) {
            return redirect('/login-admin');
        }
        
        // Ubah bagian ini! Arahkan ke folder products dan file tambah-produk
        return view('admin.products.tambah-produk'); 
    }

    public function stok() {
        if (!session('admin_logged_in')) return redirect('/login-admin');
        return view('admin.stok'); 
    }

    public function pesanan() {
        if (!session('admin_logged_in')) return redirect('/login-admin');
        return view('admin.pesanan'); // 
    }

    public function simpan_produk(Request $request) {
    $request->validate([
        'nama_produk'      => 'required|string|max:255',
        'harga'            => 'required|numeric|min:0',
        'stok'             => 'required|numeric|min:0',
        'kategori'         => 'required|string',
        'deskripsi_produk' => 'required|string',
        'gambar'           => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_gambar = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/produk'), $nama_gambar);
    }

    DB::table('produk')->insert([
        'nama_produk'      => $request->nama_produk,
        'harga'            => $request->harga,
        'stok'             => $request->stok,
        'kategori'         => $request->kategori,
        'deskripsi_produk' => $request->deskripsi_produk,
        'gambar'           => $nama_gambar, 
    ]);

    return redirect()->back()->with('status_sukses', 'Sip! Produk baru berhasil disimpan ke database.');
}
    public function daftar_produk() {
        $produk = DB::table('produk')->get();
        return view('admin.products.daftar-produk', compact('produk'));
    }

    public function edit_produk($id) {
        $produk = DB::table('produk')->where('id_produk', $id)->first();
        return view('admin.products.edit-produk', compact('produk'));
    }

    public function update_produk(Request $request, $id) {
        $data = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $nama_file);
            $data['gambar'] = $nama_file;
        }

        DB::table('produk')->where('id_produk', $id)->update($data);
        return redirect('/admin/produk/daftar');
    }

    public function hapus_produk($id) {
        DB::table('produk')->where('id_produk', $id)->delete();
        return redirect('/admin/produk/daftar');
    }
}