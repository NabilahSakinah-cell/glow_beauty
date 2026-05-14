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

// --- ROUTE LOGIN OWNER ---
Route::get('/login-owner', function () {
    return view('owner.owner'); 
});

Route::post('/login-owner', [\App\Http\Controllers\OwnerController::class, 'login']);

// --- PINDAHKAN KE SINI (DI LUAR AUTH) ---
// Halaman utama owner
Route::get('/owner', [\App\Http\Controllers\OwnerController::class, 'index'])->name('owner.index');


// --- ROUTE KHUSUS PELANGGAN (Bawaan Laravel Auth) ---
Route::middleware(['auth'])->group(function () {
    
    Route::get('/pelanggan/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('pelanggan.dashboard');

    Route::get('/katalog', function () {
        return view('pelanggan.katalog');
    })->name('pelanggan.katalog');
});