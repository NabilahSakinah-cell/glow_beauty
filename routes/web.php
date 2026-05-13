<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// Route Autentikasi Custom
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Dashboard (Hanya bisa diakses kalau sudah Login)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/pelanggan/dashboard', function () {
    return view('pelanggan.dashboard');
})->name('pelanggan.dashboard'); // Pastikan namanya 'pelanggan.dashboard'

    // Tambahkan route khusus pelanggan jika ada
    Route::get('/katalog', function () {
        return view('pelanggan.katalog');
    })->name('pelanggan.katalog');
});
