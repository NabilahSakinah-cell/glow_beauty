<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 font-[Poppins]">
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center shadow-sm">
        <span class="text-xl font-bold text-slate-800">Glow Admin <span class="text-rose-500">Panel</span></span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-700 transition">Logout</button>
        </form>
    </nav>

    <div class="p-8 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-800 mb-6">Halo, Admin {{ Auth::user()->name }}! 👋</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Produk</p>
                <p class="text-3xl font-bold text-slate-800 mt-2">152</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Pesanan Masuk</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">24</p>
            </div>
            <div class="bg-amber-50 p-6 rounded-2xl shadow-sm border border-amber-100">
                <p class="text-amber-600 text-xs font-bold uppercase tracking-wider">Stok Menipis</p>
                <p class="text-3xl font-bold text-amber-700 mt-2">5 Item</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h3 class="font-bold text-slate-800 mb-4">Aksi Cepat Admin</h3>
            <div class="flex gap-4">
                <button class="bg-rose-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-rose-600 transition shadow-lg shadow-rose-200">+ Tambah Produk Baru</button>
                <button class="bg-slate-100 text-slate-700 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition">Lihat Semua Pesanan</button>
            </div>
        </div>
    </div>
</body>
</html>