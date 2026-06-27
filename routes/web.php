<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PelangganController;

// ==========================================
// 🟢 JALUR PUBLIK (BISA DIAKSES TANPA LOGIN)
// ==========================================

// 1. Landing Page (Tampilan awal web saat pertama kali dibuka)
Route::get('/', function () {
    try {
        $produk = DB::table('produk')->take(8)->get();
    } catch (\Throwable $e) {
        $produk = DB::table('products')->take(8)->get();
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
Route::get('/dashboard', [PelangganController::class, 'index']);


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

    // Fitur Keranjang Belanja & Checkout
    Route::get('/keranjang', [ProdukController::class, 'keranjang'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{id}', [ProdukController::class, 'tambahKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/update/{id}', [ProdukController::class, 'updateJumlah'])->name('keranjang.update');
    
    Route::get('/keranjang/checkout', [ProdukController::class, 'checkoutForm'])->name('keranjang.checkout.form');
    Route::post('/keranjang/checkout', [ProdukController::class, 'checkout'])->name('keranjang.checkout');

    // Fitur Lacak Paket
    Route::get('/pelanggan/lacak', [ProdukController::class, 'lacakPaket'])->name('pelanggan.lacak');
    
    // ✨ TAMBAHAN: Route untuk Halaman Profil Pengguna
    Route::get('/pelanggan/profil', [ProdukController::class, 'profil'])->name('pelanggan.profil');

   // Route ini bertugas menangkap data dari form saat tombol "Kirim Rating" ditekan
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
});


// ==========================================
// 👑 JALUR OWNER (Sistem Manual Session Owner)
// ==========================================
Route::get('/login-owner', function () {
    return view('owner.owner'); 
});
Route::post('/login-owner', [OwnerController::class, 'login']);
Route::get('/owner', [OwnerController::class, 'index'])->name('owner.index');
Route::get('/owner/produk', [ProdukController::class, 'index'])->name('owner.produk.index');
Route::get('/owner/pesanan', [OwnerController::class, 'pesanan'])->name('owner.pesanan.index');
Route::get('/owner/pelanggan', [AdminController::class, 'index'])->name('owner.pelanggan.index');

// ==========================================
// 🛠️ JALUR ADMIN (Manajemen Produk & Katalog)
// ==========================================
Route::get('/login-admin', function () {
    return view('admin.login'); 
});
Route::post('/login-admin', [AdminController::class, 'login']);

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/pesanan', [AdminController::class, 'pesanan'])->name('admin.pesanan');

Route::get('/admin/pesanan/detail/{id}', [AdminController::class, 'detail_pesanan'])->name('admin.pesanan.detail');
Route::get('/admin/pesanan/edit/{id}', [AdminController::class, 'edit_pesanan'])->name('admin.pesanan.edit');
Route::put('/admin/pesanan/update/{id}', [AdminController::class, 'update_pesanan'])->name('admin.pesanan.update');

// Kelola Produk & Stok
Route::get('/admin/produk/daftar', [ProdukController::class, 'index']); 
Route::get('/admin/stok', [ProdukController::class, 'stok'])->name('admin.stok'); 
Route::get('/admin/produk', [ProdukController::class, 'create'])->name('admin.produk.create'); 
Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('admin.produk.store');
Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']); 
Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update_produk']);
Route::get('/admin/produk/hapus/{id}', [ProdukController::class, 'hapus_produk']);
Route::get('/admin/pesanan/export', [App\Http\Controllers\AdminController::class, 'export'])->name('admin.pesanan.export');