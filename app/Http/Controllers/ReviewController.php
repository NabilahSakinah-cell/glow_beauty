<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Ini adalah fungsi yang dipanggil saat tombol diklik
    public function create($id) {
    // KITA TAMPILKAN DATA SEBAGAI TEST
    $order = \DB::table('pesanan')->where('id_pesanan', $id)->first();
    
    // HAPUS SEMUA redirect() DAN GANTI DENGAN INI:
    return view('review.create', compact('order'));
}

        public function store(Request $request)
    {
        // 1. Validasi
        $request->validate(['id_pesanan' => 'required', 'rating' => 'required', 'komentar' => 'required']);

        // 2. Simpan
        \DB::table('reviews')->insert([
            'id_pesanan' => $request->id_pesanan,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'created_at' => now(),
        ]);

        // 3. Redirect agar user tahu berhasil
        return redirect()->route('pelanggan.dashboard')->with('success', 'Penilaian Anda berhasil dikirim!');
    }

      public function indexAdmin()
    {
        // Hanya ambil data dari tabel reviews saja
        $reviews = \DB::table('reviews')->get(); 
        return view('admin.reviews.index', compact('reviews'));
    }

        public function index()
        {
        $reviews = \App\Models\Review::all(); // Mengambil semua data dari tabel reviews
        return view('admin.reviews.index', compact('reviews'));
    }

}