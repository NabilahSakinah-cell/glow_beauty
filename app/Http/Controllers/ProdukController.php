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

    public function store(Request $request)
    {
        $namaTabel = Schema::hasTable('produk') ? 'produk' : 'products';
        $kolomTersedia = Schema::getColumnListing($namaTabel);

        $namaFoto = 'default.png';
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('uploads/produk'), $namaFoto);
        } elseif ($request->hasFile('gambar')) {
            $namaFoto = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/produk'), $namaFoto);
        }

        $nama_final      = $request->nama ?? $request->nama_produk ?? 'Produk Kosmetik';
        $harga_final     = $request->harga ?? 0;
        $kategori_final  = $request->kategori ?? 'Umum';
        $stok_final      = $request->stok ?? 10;
        $deskripsi_final = $request->deskripsi ?? $request->deskripsi_produk ?? 'Produk kecantikan Glow Beauty';

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

        try {
            DB::table($namaTabel)->insert($dataSimpan);
        } catch (\Throwable $errFinal) {
            dd([
                'STATUS' => 'Gagal total saat melakukan insert!',
                'PESAN_ERROR_MYSQL' => $errFinal->getMessage()
            ]);
        }

        return redirect()->back()->with('success', 'Produk kosmetik baru berhasil di-upload! ✨');
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
        $produk = DB::table('produk')->where('id_produk', $id)->first();

        if (!$produk) {
            $produk = DB::table('products')->where('id', $id)->first();
        }

        if (!$produk) {
            return redirect()->back()->with('error', 'Data produk tidak ditemukan di database!');
        }

        return view('admin.produk.edit-produk', compact('produk'));
    }

    public function update_produk(Request $request, $id)
    {
        $data = [
            'nama_produk'      => $request->nama_produk,
            'kategori'         => $request->kategori,
            'harga'            => $request->harga,
            'stok'             => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk,
        ];
        
        $affected = DB::table('produk')->where('id_produk', $id)->update($data);
        
        if ($affected === 0) {
            DB::table('products')->where('id', $id)->update($data);
        }
        
        return redirect('/admin/produk/daftar')->with('success', 'Data produk berhasil diperbarui!');
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

    public function indexPelanggan(Request $request)
    {
        $query = DB::table('produk');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('harga_max') && $request->harga_max != '') {
            $query->where('harga', '<=', $request->harga_max);
        }

        $produk = $query->get();

        return view('pelanggan.dashboard', compact('produk'));
    }

    public function showPelanggan($id)
    {
        $produk = DB::table('produk')->where('id', $id)->first() 
                  ?? DB::table('produk')->where('id_produk', $id)->first();

        if (!$produk) {
            return redirect()->route('pelanggan.dashboard')->with('error', 'Produk tidak ditemukan!');
        }

        return view('pelanggan.detail', compact('produk'));
    }

} 