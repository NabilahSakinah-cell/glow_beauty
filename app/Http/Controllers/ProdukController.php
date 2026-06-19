<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProdukController extends Controller
{ 
    // ==========================================
    // 🛠️ BAGIAN ADMIN (MANAJEMEN PRODUK)
    // ==========================================

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
        
        DB::table('produk')->where('id_produk', $id)->update($data);
        return redirect('/admin/produk/daftar')->with('success', 'Data produk berhasil diperbarui!');
    }

    public function hapus_produk($id)
    {
        try {
            DB::table('produk')->where('id_produk', $id)->orWhere('id', $id)->delete();
        } catch (\Throwable $e) {
            DB::table('products')->where('id', $id)->delete();
        }
        return redirect('/admin/produk/daftar')->with('success', 'Data produk berhasil dihapus!');
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


    // ==========================================
    // 👤 BAGIAN PELANGGAN (KATALOG & DETAIL)
    // ==========================================

    public function indexPelanggan(Request $request)
    {    
        $query = DB::table('produk');
        
        
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_produk', 'like', $searchTerm)
                ->orWhere('deskripsi_produk', 'like', $searchTerm); 
    });
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

    public function detail($id)
    {
        $produk = DB::table('produk')->where('id', $id)->first() 
                  ?? DB::table('produk')->where('id_produk', $id)->first();

        if (!$produk) {
            return redirect()->route('pelanggan.dashboard')->with('error', 'Produk tidak ditemukan!');
        }

        return view('pelanggan.detail', compact('produk'));
    }


    // ==========================================
    // 🛒 FITUR KERANJANG BELANJA (SESSION)
    // ==========================================

    public function keranjang()
{
    $keranjang = DB::table('detail_keranjang')
        ->join('produk', 'detail_keranjang.id_produk', '=', 'produk.id_produk')
        ->where('detail_keranjang.id_keranjang', 1)
        ->select('detail_keranjang.*', 'produk.gambar', 'produk.gambar') 
        ->get();
        
        return view('pelanggan.keranjang', compact('keranjang'));
}
    

    public function tambahKeranjang($id)
{
    // 1. Ambil data produk
    $produk = DB::table('produk')->where('id_produk', $id)->first();
    if (!$produk) return back()->with('error', 'Produk tidak ditemukan!');

     // 2. Hitung harga setelah diskon (kalau ada diskon)
    $hargaFinal = $produk->harga;
    if (isset($produk->diskon) && $produk->diskon > 0) {
        $hargaFinal = $produk->harga - ($produk->harga * ($produk->diskon / 100));
    }

    // 3. Cek apakah sudah ada di keranjang
    $ada = DB::table('detail_keranjang')
                ->where('id_keranjang', 1)
                ->where('id_produk', $id)
                ->first();

    if ($ada) {
        // Jika sudah ada, tambah jumlahnya
        DB::table('detail_keranjang')
            ->where('id_detail_keranjang', $ada->id_detail_keranjang)
            ->update(['jumlah' => $ada->jumlah + 1]);
    } else {
        // Jika belum ada, masukkan baru
        DB::table('detail_keranjang')->insert([
            'id_keranjang' => 1,
            'id_produk'    => $produk->id_produk,
            'nama_produk'  => $produk->nama_produk,
            'harga'        => $hargaFinal,
            'jumlah'       => 1
        ]);
    }
    // 3. Arahkan ke halaman keranjang
    return redirect('/keranjang')->with('success', 'Produk masuk keranjang! ✨');
}


public function updateJumlah(Request $request, $id)
{
    $aksi = $request->aksi; // 'tambah' atau 'kurang'
    $item = DB::table('detail_keranjang')->where('id_detail_keranjang', $id)->first();

    if ($item) {
        $jumlahBaru = ($aksi == 'tambah') ? $item->jumlah + 1 : $item->jumlah - 1;

        if ($jumlahBaru <= 0) {
            DB::table('detail_keranjang')->where('id_detail_keranjang', $id)->delete();
        } else {
            DB::table('detail_keranjang')->where('id_detail_keranjang', $id)->update(['jumlah' => $jumlahBaru]);
        }
    }
    return back();
}

public function checkout(Request $request)
{
    // 1. Ambil data keranjang
    $keranjang = DB::table('detail_keranjang')->where('id_keranjang', 1)->get();
    
    if ($keranjang->isEmpty()) {
        return back()->with('error', 'Keranjang kosong!');
    }
    // 2. Hitung total harga
    $total = $keranjang->sum(fn($item) => $item->harga * $item->jumlah);

    // 3. Simpan ke tabel 'pesanan'
    $idPesanan = DB::table('pesanan')->insertGetId([
        'id_pelanggan'    => auth()->id(),
        'tanggal_pesanan' => now()->timestamp, // Atau gunakan format date('Y-m-d')
        'total_harga'     => $total,
        'alamat'          => $request->alamat ?? 'Belum diisi', 
        'no_telepon'      => $request->no_telepon ?? '-',
        'status'          => 'Pending'
    ]);
    // 4. Simpan ke tabel 'detail_pesanan' (Daftar produknya)
    foreach ($keranjang as $item) {
        DB::table('detail_pesanan')->insert([
            'id_pesanan' => $idPesanan, // Mengambil ID dari tabel pesanan di atas
            'id_produk'  => $item->id_produk,
            'jumlah'     => $item->jumlah,
            'subtotal'   => $item->harga * $item->jumlah
        ]);
    }
    // 5. Hapus keranjang
    DB::table('detail_keranjang')->where('id_keranjang', 1)->delete();

    return redirect()->route('pelanggan.dashboard')->with('success', 'Checkout berhasil!');
}

public function checkoutForm()
{
    // Mengambil data keranjang untuk ditampilkan ringkasannya di halaman checkout
    $keranjang = DB::table('detail_keranjang')->where('id_keranjang', 1)->get();
    return view('pelanggan.checkout', compact('keranjang'));
}
}