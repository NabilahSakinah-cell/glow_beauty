<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController; 

// ==========================================
// Halaman Utama / Landing Page
// ==========================================
Route::get('/', [ProdukController::class, 'indexpelanggan'])->name('home');
Route::get('/pelanggan/dashboard', [ProdukController::class, 'index'])->name('pelanggan.dashboard');

// ==========================================
// JALUR PELANGGAN (Form Login & Register)
// ==========================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// JALUR OWNER (Sistem Manual Session Owner)
// ==========================================
Route::get('/login-owner', function () {
    return view('owner.owner'); 
});
Route::post('/login-owner', [OwnerController::class, 'login']);
Route::get('/owner', [OwnerController::class, 'index'])->name('owner.index');

// ==========================================
// JALUR ADMIN (Manajemen Produk & Katalog)
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

Route::get('/admin/produk/daftar', [ProdukController::class, 'index']); 
Route::get('/admin/stok', [ProdukController::class, 'stok'])->name('admin.stok'); 
Route::get('/admin/produk', [ProdukController::class, 'create'])->name('admin.produk.create'); 

Route::post('/admin/produk/simpan', [ProdukController::class, 'store'])->name('admin.produk.store');

Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']); 
Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update_produk']);
Route::get('/admin/produk/hapus/{id}', [ProdukController::class, 'hapus_produk']);

// ==========================================
// JALUR PROTEKSI PELANGGAN (Middleware Auth)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function() {
        return redirect()->route('pelanggan.dashboard');
    });
    
    Route::post('/keranjang/tambah/{id}', [ProdukController::class, 'tambahKeranjang'])
     ->name('keranjang.tambah');

    Route::post('/keranjang/checkout', [ProdukController::class, 'checkout'])
     ->name('keranjang.checkout');

    Route::get('/pelanggan/dashboard', [ProdukController::class, 'indexpelanggan'])->name('pelanggan.dashboard');

    Route::get('/katalog', function () {
        return view('pelanggan.katalog');
    })->name('pelanggan.katalog');

    // ✨ TYPO DOUBLE CONTROLLER SUDAH DIPERBAIKI DI SINI:
    Route::get('/keranjang', [ProdukController::class, 'keranjang'])->name('keranjang.index');
});