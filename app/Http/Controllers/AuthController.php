<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==========================================
    // 📝 BAGIAN REGISTER (DAFTAR AKUN)
    // ==========================================

    // Menampilkan Halaman Register Pelanggan
    public function showRegister()
    {
        return view('auth.register'); 
    }

    // Memproses Pendaftaran & AUTO-LOGIN
    public function register(Request $request)
    {
        // 1. Validasi data yang diisi pelanggan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // 2. Simpan akun baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. ✨ AUTO LOGIN: Langsung loginkan user yang baru dibuat!
        Auth::login($user);

        // 4. Arahkan ke halaman Katalog ala Shopee
        return redirect('/katalog')->with('success', 'Akun berhasil dibuat! Kamu sudah otomatis login. ✨');
    }


    // ==========================================
    // 🔐 BAGIAN LOGIN (MASUK AKUN)
    // ==========================================

    // Menampilkan Halaman Login Pelanggan
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses Masuk Akun Pelanggan
    public function login(Request $request)
    {
        // 1. Validasi inputan
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cek kecocokan email dan password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // 3. Jika berhasil, arahkan ke Katalog
            return redirect('/katalog')->with('success', 'Selamat datang kembali di Glow Beauty! ✨');
        }

        // 4. Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }


    // ==========================================
    // 🚪 BAGIAN LOGOUT (KELUAR AKUN)
    // ==========================================

    // Keluar Akun Pelanggan
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // ✨ KEMBALI KE LANDING PAGE: Arahkan ke '/' sesuai permintaanmu
        return redirect('/')->with('success', 'Kamu telah berhasil logout. Sampai jumpa lagi! ✨');
    }
}