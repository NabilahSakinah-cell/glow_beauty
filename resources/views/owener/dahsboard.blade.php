<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Owner Dashboard - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-[Poppins]">
    <div class="p-8 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold">Business Overview ✨</h1>
                <p class="text-gray-400 mt-1">Selamat datang kembali, Owner {{ Auth::user()->name }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}"> @csrf <button class="bg-white/10 hover:bg-white/20 px-6 py-2 rounded-full transition border border-white/20">Keluar</button> </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gradient-to-br from-rose-600 to-rose-800 p-8 rounded-3xl shadow-2xl">
                <p class="text-rose-200 font-semibold text-sm uppercase">Omzet Bulan Ini</p>
                <p class="text-4xl font-bold mt-2">Rp 45.200.000</p>
                <div class="mt-4 inline-block bg-white/20 px-3 py-1 rounded-full text-xs">↑ 12% Performa meningkat</div>
            </div>
            <div class="bg-white/5 p-8 rounded-3xl border border-white/10">
                <p class="text-gray-400 font-semibold text-sm uppercase">Total Pelanggan</p>
                <p class="text-4xl font-bold mt-2">1,204</p>
                <p class="text-xs text-gray-500 mt-4 underline cursor-pointer hover:text-rose-400 italic">Lihat rincian pelanggan baru</p>
            </div>
        </div>

       <div class="bg-white/5 p-8 rounded-3xl border border-white/10">
    <h3 class="font-bold mb-6 text-xl">Top Selling Products</h3>
    <div class="space-y-4 text-sm">
        <div class="flex justify-between border-b border-white/10 pb-2"><span>Serum Anti-Aging Gold</span> <span class="text-rose-400 font-bold">120 terjual</span></div>
        <div class="flex justify-between border-b border-white/10 pb-2"><span>Sunscreen Lavender Mist</span> <span class="text-rose-400 font-bold">95 terjual</span></div>
    </div>
</div>
</body>
</html>