<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProdukController extends Controller
{ 
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        try {
            $produk = DB::table('produk')->get();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->get();
        }
        
        try {
            return view('admin.produk.daftar-produk', compact('produk'));
        } catch (\Throwable $e) {
            return view('admin.products.daftar-produk', compact('produk'));
        }
    }

    public function create()
    {
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

    /**
     * PROSES SIMPAN PRODUK - MODE ULTRA AMAN (AUTO-DETECT KOLOM)
     */
    public function store(Request $request)
    {
        // 1. Deteksi nama tabel yang aktif di database kamu
        $namaTabel = Schema::hasTable('produk') ? 'produk' : 'products';

        // 2. Ambil daftar kolom asli dari tabel database kamu secara live
        $kolomTersedia = Schema::getColumnListing($namaTabel);

        // 3. Proses upload file gambar/foto secara fleksibel
        $namaFoto = 'default.png';
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('uploads/produk'), $namaFoto);
        } elseif ($request->hasFile('gambar')) {
            $namaFoto = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/produk'), $namaFoto);
        }

        // 4. Tangkap seluruh data dari Form HTML
        $nama_final      = $request->nama ?? $request->nama_produk ?? 'Produk Kosmetik';
        $harga_final     = $request->harga ?? 0;
        $kategori_final  = $request->kategori ?? 'Umum';
        $stok_final      = $request->stok ?? 10;
        $deskripsi_final = $request->deskripsi ?? $request->deskripsi_produk ?? 'Produk kecantikan Glow Beauty';

        // 5. Filter data: Hanya masukkan data jika nama kolomnya ada di database kamu!
        $dataSimpan = [];

        if (in_array('nama', $kolomTersedia)) $dataSimpan['nama'] = $nama_final;
        if (in_array('nama_produk', $kolomTersedia)) $dataSimpan['nama_produk'] = $nama_final;
        
        if (in_array('kategori', $kolomTersedia)) $dataSimpan['kategori'] = $kategori_final;
        if (in_array('harga', $kolomTersedia)) $dataSimpan['harga'] = $harga_final;
        if (in_array('stok', $kolomTersedia)) $dataSimpan['stok'] = $stok_final;
        
        if (in_array('deskripsi', $kolomTersedia)) $dataSimpan['deskripsi'] = $deskripsi_final;
        if (in_array('deskripsi_produk', $kolomTersedia)) $dataSimpan['deskripsi_produk'] = $deskripsi_final;
        
        if (in_array('foto', $kolomTersedia)) $dataSimpan['foto'] = $namaFoto;
        if (in_array('gambar', $kolomTersedia)) $dataSimpan['gambar'] = $namaFoto;
        
        if (in_array('created_at', $kolomTersedia)) $dataSimpan['created_at'] = now();
        if (in_array('updated_at', $kolomTersedia)) $dataSimpan['updated_at'] = now();

        // 6. Eksekusi penyimpanan ke tabel database
        try {
            DB::table($namaTabel)->insert($dataSimpan);
        } catch (\Throwable $errFinal) {
            // Jika skenario terburuk masih gagal, bongkar struktur lengkapnya ke layar untuk dibaca
            dd([
                'STATUS' => 'Gagal total saat melakukan insert!',
                'NAMA_TABEL' => $namaTabel,
                'KOLOM_YANG_ADA_DI_DATABASE_KAMU' => $kolomTersedia,
                'DATA_YANG_DIKIRIM_LARAVEL' => $dataSimpan,
                'PESAN_ERROR_MYSQL' => $errFinal->getMessage()
            ]);
        }

        // 7. Kembali ke halaman form dengan status sukses
        return redirect()->back()->with('success', 'Produk kosmetik baru berhasil di-upload! ✨');
    }

    public function indexPelanggan()
    {
        try {
            $produk = DB::table('produk')->get();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->get();
        }

        return view('pelanggan.dashboard', compact('produk'));
    }

    public function stok()
    {
        try {
            $produk = DB::table('produk')->get();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->get();
        }
        
        return view('admin.stok', compact('produk'));
    }

    public function edit($id)
    {
        try {
            $produk = DB::table('produk')->where('id_produk', $id)->orWhere('id', $id)->first();
        } catch (\Throwable $e) {
            $produk = DB::table('products')->where('id', $id)->first();
        }

        try {
            return view('admin.produk.edit-produk', compact('produk'));
        } catch (\Throwable $e) {
            return view('admin.products.edit-produk', compact('produk'));
        }
    }

    public function pesanan()
    {
        try {
            $pesanan = DB::table('pesanan')->get(); 
        } catch (\Throwable $e) {
            try {
                $pesanan = DB::table('orders')->get();
            } catch (\Throwable $err) {
                $pesanan = [];
            }
        }
        return view('admin.pesanan', compact('pesanan'));
    }
}