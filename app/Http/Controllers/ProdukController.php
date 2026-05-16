<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{ 
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        // Mencoba mengambil data aman dengan model Product (huruf C) atau Produk (huruf K)
        try {
            $produk = \App\Models\Product::all(); 
        } catch (\Throwable $e) {
            $produk = \App\Models\Produk::all();
        }
        
        // FIX SESUAI FOLDER: Mengarah ke admin/produk/daftar-produk.blade.php
        return view('admin.produk.daftar-produk', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.tambah-produk');
    }

    public function stok()
    {
        try {
            $produk = \App\Models\Product::all(); 
        } catch (\Throwable $e) {
            $produk = \App\Models\Produk::all();
        }
        
        // FIX SESUAI FOLDER: Mengarah langsung ke admin/stok.blade.php
        return view('admin.stok', compact('produk'));
    }

    public function edit($id)
    {
        try {
            $produk = \App\Models\Product::where('id_produk', $id)->firstOrFail();
        } catch (\Throwable $e) {
            $produk = \App\Models\Produk::where('id_produk', $id)->firstOrFail();
        }
        return view('admin.produk.edit-produk', compact('produk'));
    }


     public function pesanan()
    {
        try {
            $pesanan = \App\Models\Pesanan::all(); 
        } catch (\Throwable $e) {
            $pesanan = []; 
        }
        return view('admin.pesanan', compact('pesanan'));
    }
}