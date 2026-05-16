<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User bawaan Laravel sudah ada
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Halaman Register Pelanggan
    public function showRegister()
    {
        return view('auth.register'); // Sesuaikan letak file register.blade.php kamu
    }

    // Memproses Pendaftaran Data Pelanggan Baru (Poin A)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kirim Notifikasi Berhasil (Poin L)
        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan masuk.');
    }

    // Menampilkan Halaman Login Pelanggan
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses Masuk Akun Pelanggan (Poin B)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Jika berhasil login, lempar ke katalog produk utama
            return redirect('/')->with('success', 'Selamat datang di Glow Beauty! ✨');
        }

        // Kirim Notifikasi Gagal (Poin L)
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Keluar Akun Pelanggan
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah keluar.');
    }
}