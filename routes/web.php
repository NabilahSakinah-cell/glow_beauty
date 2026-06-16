<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProdukController; 

// ==========================================
// 🟢 JALUR PUBLIK (BISA DIAKSES TANPA LOGIN)
// ==========================================

// 1. Landing Page (Tampilan awal web saat pertama kali dibuka)
Route::get('/', function () {
    // Ambil 4 produk dari database untuk bagian "Produk Terlaris"
    try {
        $produk = DB::table('produk')->take(4)->get();
    } catch (\Throwable $e) {
        $produk = DB::table('products')->take(4)->get();
    }
    
    return view('welcome', compact('produk')); 
})->name('home');

// 2. Halaman Katalog Produk ala Shopee (Bisa lihat produk tanpa akun)
Route::get('/katalog', [ProdukController::class, 'indexpelanggan'])->name('katalog');

// 3. Detail Produk (Bebas lihat detail & rating tanpa login)
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');


// ==========================================
// 👤 JALUR PELANGGAN (Form Login & Register)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// 🔴 JALUR TRANSAKSI (HARUS LOGIN DULU)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Jika mengetik /dashboard, otomatis diarahkan ke halaman katalog
    Route::get('/dashboard', function() {
        return redirect()->route('katalog');
    });
    
    // Dashboard Pelanggan
    Route::get('/pelanggan/dashboard', [ProdukController::class, 'indexpelanggan'])->name('pelanggan.dashboard');

    // Fitur Keranjang Belanja & Checkout (Aman terlindungi)
    Route::get('/keranjang', [ProdukController::class, 'keranjang'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{id}', [ProdukController::class, 'tambahKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/checkout', [ProdukController::class, 'checkout'])->name('keranjang.checkout');

});


// ==========================================
// 👑 JALUR OWNER (Sistem Manual Session Owner)
// ==========================================
Route::get('/login-owner', function () {
    return view('owner.owner'); 
});
Route::post('/login-owner', [OwnerController::class, 'login']);
Route::get('/owner', [OwnerController::class, 'index'])->name('owner.index');


// ==========================================
// 🛠️ JALUR ADMIN (Manajemen Produk & Katalog)
// ==========================================
Route::get('/login-admin', function () {
    return view('admin.login'); 
});
Route::post('/login-admin', [AdminController::class, 'login']);

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/pesanan', function () {
    $pesanan = [];
    return view('admin.pesanan', compact('pesanan'));
})->name('admin.pesanan');

// Kelola Produk & Stok
Route::get('/admin/produk/daftar', [ProdukController::class, 'index']); 
Route::get('/admin/stok', [ProdukController::class, 'stok'])->name('admin.stok'); 
Route::get('/admin/produk', [ProdukController::class, 'create'])->name('admin.produk.create'); 
Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('admin.produk.store');
Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']); 
Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update_produk']);
Route::get('/admin/produk/hapus/{id}', [ProdukController::class, 'hapus_produk']);