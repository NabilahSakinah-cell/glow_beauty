<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-6 md:p-8 min-h-screen">

    <div class="max-w-7xl mx-auto animate-fade-in">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-serif font-bold text-rose-950">Business Overview ✨</h1>
                <p class="text-slate-500 text-sm mt-1">Selamat datang kembali di Ruang Kerja, <span class="font-semibold text-rose-600">Owner {{ session('owner_nama') ?? 'Nabila' }}</span></p>
            </div>
            
            <a href="/login-owner" class="bg-white hover:bg-rose-600 text-rose-600 hover:text-white px-6 py-2.5 rounded-full transition-all border border-rose-200 font-semibold text-sm shadow-sm active:scale-95 duration-200">
                Keluar 🚪
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gradient-to-br from-rose-600 to-rose-700 p-8 rounded-3xl shadow-xl shadow-rose-200 text-white transform hover:scale-[1.01] transition-all duration-300">
                <p class="text-rose-100 font-medium text-xs uppercase tracking-wider">Omzet Bulan Ini 💰</p>
                <p class="text-4xl font-bold mt-2 font-serif">Rp 45.200.000</p>
                <div class="mt-4 inline-block bg-white/20 px-3 py-1 rounded-full text-xs font-medium">
                    ↑ 12% Performa meningkat bisnis kamu
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300">
                <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Pelanggan 👑</p>
                <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">1.204</p>
                <p class="text-xs text-rose-600 font-medium mt-4 underline cursor-pointer hover:text-rose-700 italic">
                    Lihat rincian pelanggan baru &rarr;
                </p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30">
            <h3 class="font-serif font-bold mb-6 text-xl text-rose-950 flex items-center gap-2">
                Top Selling Products 💄
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center border-b border-rose-50 pb-4 hover:bg-rose-50/20 px-2 rounded-xl transition duration-200">
                    <span class="text-slate-700 font-medium text-sm">Serum Anti-Aging Gold ✨</span>
                    <span class="bg-rose-50 text-rose-600 font-bold text-xs px-4 py-1.5 rounded-full border border-rose-100">120 terjual</span>
                </div>
                <div class="flex justify-between items-center border-b border-rose-50 pb-4 hover:bg-rose-50/20 px-2 rounded-xl transition duration-200">
                    <span class="text-slate-700 font-medium text-sm">Sunscreen Lavender Mist ☀️</span>
                    <span class="bg-rose-50 text-rose-600 font-bold text-xs px-4 py-1.5 rounded-full border border-rose-100">95 terjual</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>