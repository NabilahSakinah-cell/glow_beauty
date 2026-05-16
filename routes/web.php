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
Route::get('/', function () {
    return view('welcome');
});


// ==========================================
// JALUR PELANGGAN (Form Login & Register Bawaan)
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
// JALUR ADMIN (Sistem Baru - Hak Akses Admin)
// ==========================================
// 1. Halaman Form Login Admin
Route::get('/login-admin', function () {
    return view('admin.login'); 
});
Route::post('/login-admin', [AdminController::class, 'login']);

// 2. Dashboard Utama Admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// 3. Rute Fitur Kerja Admin (DIARAHKAN KE PRODUK CONTROLLER AGAR VARIABELNYA TERDEFINISI)
Route::get('/admin/produk/daftar', [ProdukController::class, 'index']); 
Route::get('/admin/stok', [ProdukController::class, 'stok'])->name('admin.stok'); 
Route::get('/admin/produk', [ProdukController::class, 'create']); 


// Untuk fungsi simpan, edit, update, dan hapus (Sesuaikan dengan nama fungsi yang ada di ProdukController Anda)
Route::post('/admin/produk/simpan', [ProdukController::class, 'simpan_produk']);
Route::get('/admin/produk/edit/{id}', [ProdukController::class, 'edit']); 
Route::post('/admin/produk/update/{id}', [ProdukController::class, 'update_produk']);
Route::get('/admin/produk/hapus/{id}', [ProdukController::class, 'hapus_produk']);


// ==========================================
// JALUR PROTEKSI PELANGGAN (Middleware Auth)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    Route::get('/pelanggan/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('pelanggan.dashboard');

    Route::get('/katalog', function () {
        return view('pelanggan.katalog');
    })->name('pelanggan.katalog');
});