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
        if (!session('owner_logged_in')) {
            return redirect('/login-owner'); 
        }
        return view('owner.dashboard');    }
}
