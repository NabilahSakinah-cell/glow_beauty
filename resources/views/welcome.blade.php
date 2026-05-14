<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Glow Beauty - Skincare & Makeup</title>

        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Poppins', sans-serif; }
            .font-serif { font-family: 'Playfair Display', serif; }
        </style>
    </head>
    <body class="antialiased bg-rose-50 text-gray-800">
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-rose-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-serif font-bold text-rose-600">Glow Beauty</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                    @auth
                <a href="{{ url('/pelanggan/dashboard') }}" class="text-sm font-medium text-rose-700 hover:text-rose-900 bg-rose-100 px-4 py-2 rounded-full transition">Dashboard</a>
            @else
        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-rose-600 transition">Masuk</a>
        <a href="/login-owner" class="text-sm font-medium text-rose-600 border border-rose-600 hover:bg-rose-50 px-4 py-1.5 rounded-full transition">Owner Area</a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-rose-600 hover:bg-rose-700 px-5 py-2 rounded-full transition shadow-md shadow-rose-200">Daftar Admin</a>
@endif
@endauth
    @endif
</div>
                </div>
            </div>
        </nav>

        <header class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center py-16 px-4 sm:px-6 lg:px-8">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-5xl font-serif font-bold text-rose-900 leading-tight mb-6">
                        Tingkatkan Kepercayaan Dirimu dengan <span class="text-rose-600 italic">Glow Beauty</span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Solusi manajemen stok dan pesanan skincare terbaik. Kelola produk makeup dengan sistem yang terstruktur, efisien, dan modern.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('register') }}" class="bg-rose-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-rose-700 transition shadow-lg">Mulai Sekarang</a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center relative">
                    <div class="w-80 h-80 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 absolute animate-pulse"></div>
                    <div class="bg-rose-100 w-72 h-96 rounded-t-full border-4 border-white shadow-2xl flex items-center justify-center">
                         <span class="text-rose-300 font-serif text-xl italic">Glow Beauty Image</span>
                    </div>
                </div>
            </div>
        </header>

        <section class="py-20 bg-rose-50">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h3 class="text-3xl font-serif font-bold text-rose-900 mb-12 text-center">Mengapa Memilih Sistem Kami?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-rose-100">
                        <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center mx-auto mb-4 text-rose-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">Manajemen Stok</h4>
                        <p class="text-sm text-gray-500">Pantau ketersediaan produk skincare dan makeup secara real-time.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-rose-100">
                        <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center mx-auto mb-4 text-rose-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">Proses Pesanan</h4>
                        <p class="text-sm text-gray-500">Alur pemesanan yang terstruktur mulai dari keranjang hingga riwayat.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-rose-100">
                        <div class="w-12 h-12 bg-rose-100 rounded-lg flex items-center justify-center mx-auto mb-4 text-rose-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 2v-6m10 10V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">Laporan Efisien</h4>
                        <p class="text-sm text-gray-500">Mudahkan owner dalam memantau perkembangan usaha kecantikan.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-white py-12 border-t border-rose-100">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-rose-600 font-serif font-bold text-xl mb-4">Glow Beauty</p>
                <p class="text-gray-400 text-sm italic mb-6">"Your beauty, our management priority."</p>
                <div class="text-gray-500 text-xs leading-loose">
                    &copy; 2026 ITH - Program Studi Ilmu Komputer <br>
                    Tim Pengembang: Muh Nur Hidayah, Nadia Rahma , Nabila Sakinah, Nur Aini, Alfiana Muhsin
                </div>
            </div>
        </footer>
    </body>
</html>