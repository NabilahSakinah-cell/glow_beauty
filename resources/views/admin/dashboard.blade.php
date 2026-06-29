<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-rose-50/50 text-slate-800 min-h-screen">
    <div class="p-8 max-w-7xl mx-auto animate-fade-in">
        
        <div class="flex justify-between items-center mb-10 border-b border-rose-100 pb-5">
            <div>
                <h1 class="text-3xl font-bold text-rose-600 transition-colors duration-300 hover:text-rose-700">Admin Workspace 🛠️</h1>
                <p class="text-slate-500 mt-1">Selamat bertugas, {{ session('admin_nama') ?? 'Admin Glow Beauty' }}</p>
            </div>
            <a href="/login-admin" class="bg-red-50 hover:bg-red-500 hover:text-white text-red-600 px-5 py-2 rounded-full transition-all duration-300 transform hover:scale-105 border border-red-200 text-sm font-medium shadow-sm active:scale-95">
                Keluar Sistem
            </a>
        </div>

        <div class="bg-gradient-to-r from-rose-500 to-pink-600 p-6 rounded-2xl shadow-md shadow-rose-200 text-white mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold">Punya Koleksi Kosmetik Baru? ✨</h2>
                <p class="text-rose-100 text-sm mt-1">Unggah produk kosmetik terbaru ke database agar langsung bisa diorder pelanggan.</p>
            </div>
            <a href="/admin/produk" class="bg-white text-rose-600 hover:bg-rose-50 px-6 py-3 rounded-xl font-bold text-sm shadow-sm transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                <i class="fa-solid fa-square-plus text-base"></i> Tambah Produk Baru
            </a>
        </div>

        <h2 class="text-xl font-semibold mb-6 text-rose-950">Menu Manajemen Kerja Admin:</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="group bg-white p-6 rounded-2xl border border-rose-100 hover:border-rose-400 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl hover:shadow-rose-100/70">
                <div class="text-3xl mb-4 inline-block transition-transform duration-300 group-hover:animate-bounce">🛍️</div>
                <h3 class="text-lg font-bold mb-2 text-rose-900 group-hover:text-rose-600 transition-colors">Data Produk</h3>
                <p class="text-sm text-slate-500 mb-5">Lihat daftar tabel kosmetik aktif, ubah rincian deskripsi harga, atau hapus produk lama.</p>
                <a href="/admin/produk/daftar" class="inline-block w-full text-center bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium py-2.5 rounded-xl transition-all duration-300 transform group-hover:scale-[1.02] active:scale-95 shadow-sm shadow-rose-200">
                    Kelola Produk
                </a>
            </div>

            <div class="group bg-white p-6 rounded-2xl border border-rose-100 hover:border-rose-400 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl hover:shadow-rose-100/70">
                <div class="text-3xl mb-4 inline-block transition-transform duration-300 group-hover:animate-bounce">📦</div>
                <h3 class="text-lg font-bold mb-2 text-rose-900 group-hover:text-rose-600 transition-colors">Stok Barang</h3>
                <p class="text-sm text-slate-500 mb-5">Pantau jumlah persediaan produk kosmetik terupdate agar tidak kehabisan penjualan.</p>
                <a href="/admin/stok" class="inline-block w-full text-center bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium py-2.5 rounded-xl transition-all duration-300 transform group-hover:scale-[1.02] active:scale-95 shadow-sm shadow-rose-200">
                    Atur Stok
                </a>
            </div>

            <div class="group bg-white p-6 rounded-2xl border border-rose-100 hover:border-rose-400 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl hover:shadow-rose-100/70">
                <div class="text-3xl mb-4 inline-block transition-transform duration-300 group-hover:animate-bounce">📜</div>
                <h3 class="text-lg font-bold mb-2 text-rose-900 group-hover:text-rose-600 transition-colors">Data Pesanan</h3>
                <p class="text-sm text-slate-500 mb-5">Lihat list pesanan masuk dari pelanggan dan kelola status pengirimannya.</p>
                <a href="{{ route('admin.pesanan') }}" class="inline-block w-full text-center bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium py-2.5 rounded-xl transition-all duration-300 transform group-hover:scale-[1.02] active:scale-95 shadow-sm shadow-rose-200">
    Lihat Pesanan
</a>
            </div>

        <div class="group bg-white p-6 rounded-2xl border border-rose-100 hover:border-rose-400 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl hover:shadow-rose-100/70">
        <div class="text-3xl mb-4 inline-block transition-transform duration-300 group-hover:animate-bounce">⭐</div>
        <h3 class="text-lg font-bold mb-2 text-rose-900 group-hover:text-rose-600 transition-colors">Data Rating</h3>
        <p class="text-sm text-slate-500 mb-5">Lihat ulasan dan penilaian dari pelanggan untuk produk Anda.</p>
        <a href="{{ route('admin.reviews') }}" class="inline-block w-full text-center bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium py-2.5 rounded-xl transition-all duration-300 transform group-hover:scale-[1.02] active:scale-95 shadow-sm shadow-rose-200">
            Lihat Rating
        </a>
    </div>

        </div>
    </div>
</body>
</html>