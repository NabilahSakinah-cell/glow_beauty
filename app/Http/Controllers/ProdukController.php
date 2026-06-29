<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
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
        if (in_array('diskon', $kolomTersedia)) $dataSimpan['diskon'] = $request->diskon ?? 0;
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

        return redirect('/admin/produk/daftar')->with('success', 'Produk kosmetik baru berhasil di-upload! ✨');
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
        $produk = DB::table('produk')->where('id_produk', $id)->first();

        $data = [
            'nama_produk'      => $request->nama_produk,
            'kategori'         => $request->kategori,
            'harga'            => $request->harga,
            'diskon'           => $request->diskon,
            'stok'             => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk,
        ];
        
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(public_path('uploads/produk/' . $produk->gambar))) {
                unlink(public_path('uploads/produk/' . $produk->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/produk'), $namaFile);
            $data['gambar'] = $namaFile;
        }

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

   public function indexpelanggan(Request $request)
    {
        // 1. Ambil data produk
        $produk = Produk::all(); 

        // 2. Ambil data pesanan
        $order = \DB::table('pesanan')
                    ->where('id_pelanggan', \Auth::id())
                    ->orderBy('id_pesanan', 'desc')
                    ->first();
                    
        $status = $order ? strtolower(trim($order->status)) : 'kosong';

        // 3. Kirim status DAN order ke view (TAMBAHKAN 'order' DI SINI)
        return view('pelanggan.dashboard', compact('produk', 'status', 'order'));
    }

    public function detail($id)
    {
        $produk = DB::table('produk')->where('id_produk', $id)->first();

        if (!$produk) {
            return redirect()->route('pelanggan.dashboard')->with('error', 'Produk tidak ditemukan!');
        }

        return view('pelanggan.detail', compact('produk'));
    }


    // ==========================================
    // 🛒 FITUR KERANJANG BELANJA (SESSION & DATABASE)
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
        
        // 2. Hitung total harga dan tambah ongkir 15.000 sesuai dengan tampilan di keranjang
        $subtotal = $keranjang->sum(fn($item) => $item->harga * $item->jumlah);
        $total = $subtotal + 15000;

        // ✨ FITUR BARU: Gabungkan Dropdown Wilayah dan Detail Alamat 
        $alamatLengkap = $request->wilayah . ' - ' . $request->alamat_detail;

        // 3. Simpan ke tabel 'pesanan'
        $idPesanan = DB::table('pesanan')->insertGetId([
            'id_pelanggan'    => auth()->id(),
            'tanggal_pesanan' => now()->timestamp, // Atau gunakan format date('Y-m-d')
            'total_harga'     => $total,
            'alamat'          => $alamatLengkap, // Masukkan variabel gabungan wilayah & alamat ke DB
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

            // Pengurangan stok otomatis
            DB::table('produk')
                ->where('id_produk', $item->id_produk)
                ->decrement('stok', $item->jumlah);
        }

        // 5. Hapus keranjang
        DB::table('detail_keranjang')->where('id_keranjang', 1)->delete();

        // =========================================================
        // ✨ ESTIMASI PENGIRIMAN
        // =========================================================
        $estimasiAwal = now()->addDays(2)->format('d M Y');
        $estimasiAkhir = now()->addDays(4)->format('d M Y');
        
        $pesanSukses = "Checkout berhasil! Pesanan sedang diproses. 🚚 Estimasi paket tiba: $estimasiAwal s/d $estimasiAkhir.";

        return redirect()->route('pelanggan.dashboard')->with('success', $pesanSukses);
    }

    public function checkoutForm()
    {
        // Mengambil data keranjang untuk ditampilkan ringkasannya di halaman checkout
        $keranjang = DB::table('detail_keranjang')->where('id_keranjang', 1)->get();
        return view('pelanggan.checkout', compact('keranjang'));
    }
}