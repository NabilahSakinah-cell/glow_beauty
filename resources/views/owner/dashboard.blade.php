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
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-serif font-bold text-rose-950">Business Overview ✨</h1>
                <p class="text-slate-500 text-sm mt-1">Selamat datang kembali di Ruang Kerja, <span class="font-semibold text-rose-600">Owner {{ session('owner_nama') ?? 'Nabila' }}</span></p>
            </div>
            
            <a href="/login-owner" class="bg-white hover:bg-rose-600 text-rose-600 hover:text-white px-6 py-2.5 rounded-full transition-all border border-rose-200 font-semibold text-sm shadow-sm active:scale-95 duration-200">
                Keluar 🚪
            </a>
        </div>

        <!-- 3 Kotak Utama Atas (Sekarang Simetris Berjejer Rapi) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            
            <!-- Kotak Omzet Bulan Ini -->
            <div class="bg-gradient-to-br from-rose-600 to-rose-700 p-8 rounded-3xl shadow-xl shadow-rose-200 text-white transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-rose-100 font-medium text-xs uppercase tracking-wider">Omzet Bulan Ini 💰</p>
                    <p class="text-4xl font-bold mt-2 font-serif">Rp 45.200.000</p>
                </div>
                <div class="mt-6 inline-block bg-white/20 px-3 py-1.5 rounded-full text-xs font-medium text-center">
                    ↑ 12% Performa meningkat bisnis kamu
                </div>
            </div>

            <!-- Kotak Total Produk -->
            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Produk 📦</p>
                    <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">120</p>
                </div>
                <p class="text-xs text-rose-600 font-medium mt-6 underline cursor-pointer italic hover:text-rose-700">
                    Lihat semua produk →
                </p>
            </div>

            <!-- Kotak Total Pesanan -->
            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Pesanan 🧾</p>
                    <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">356</p>
                </div>
                <p class="text-xs text-rose-600 font-medium mt-6 underline cursor-pointer italic hover:text-rose-700">
                    Lihat semua pesanan →
                </p>
            </div>
        </div>

        <!-- Baris Kedua: Total Pelanggan & Top Selling -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Total Pelanggan -->
            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300">
                <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Pelanggan 👑</p>
                <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">1.204</p>
                <p class="text-xs text-rose-600 font-medium mt-4 underline cursor-pointer hover:text-rose-700 italic">
                    Lihat rincian pelanggan baru &rarr;
                </p>
            </div>

            <!-- Top Selling -->
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

        <!-- Laporan Penjualan & Grafik -->
        <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 mt-8">
            <h3 class="font-serif font-bold mb-6 text-xl text-rose-950">
                Laporan Penjualan Bulanan 📊
            </h3>
            <div class="max-h-[300px] flex justify-center">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Pesanan Terbaru (Tabel) -->
        <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 mt-8">
            <h3 class="font-serif font-bold mb-6 text-xl text-rose-950">
                Pesanan Terbaru 📦
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-slate-400 text-sm">
                            <th class="text-left p-3 font-medium">ID Pesanan</th>
                            <th class="text-left p-3 font-medium">Pelanggan</th>
                            <th class="text-left p-3 font-medium">Tanggal</th>
                            <th class="text-left p-3 font-medium">Total</th>
                            <th class="text-left p-3 font-medium">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="border-b hover:bg-slate-50/50 transition">
                            <td class="p-3 font-medium">#ORD00123</td>
                            <td class="p-3">Siti Aisyah</td>
                            <td class="p-3">25 Mei 2024</td>
                            <td class="p-3">Rp250.000</td>
                            <td class="p-3">
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">
                                    Selesai
                                </span>
                            </td>
                        </tr>

                        <tr class="border-b hover:bg-slate-50/50 transition">
                            <td class="p-3 font-medium">#ORD00122</td>
                            <td class="p-3">Budi Santoso</td>
                            <td class="p-3">25 Mei 2024</td>
                            <td class="p-3">Rp150.000</td>
                            <td class="p-3">
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">
                                    Diproses
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            dataType: 'json',
            datasets: [{
                label: 'Penjualan',
                data: [10000000, 12500000, 15200000, 7500000, 11000000, 14000000],
                backgroundColor: '#e11d48',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    </script>
</body>
</html>