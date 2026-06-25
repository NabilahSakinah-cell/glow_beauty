<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // 1. Cek status pesanan dulu
        $pesanan = Pesanan::findOrFail($request->pesanan_id);

        if ($pesanan->status !== 'Selesai') {
            return back()->with('Error', 'Maaf, Anda hanya bisa memberi rating jika pesanan sudah selesai.');
        }

        // 2. Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string'
        ]);

        // 3. Simpan data
        Review::create([
            'user_id' => auth()->id(),
            'produk_id' => $request->produk_id,
            'pesanan_id' => $request->pesanan_id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return back()->with('success', 'Terima kasih atas rating Anda!');
    }
}