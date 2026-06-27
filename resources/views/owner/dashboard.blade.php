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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            
            <div class="bg-gradient-to-br from-rose-600 to-rose-700 p-8 rounded-3xl shadow-xl shadow-rose-200 text-white transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-rose-100 font-medium text-xs uppercase tracking-wider">Omzet Bulan Ini 💰</p>
                    <p class="text-4xl font-bold mt-2 font-serif">Rp 45.200.000</p>
                </div>
                <div class="mt-6 inline-block bg-white/20 px-3 py-1.5 rounded-full text-xs font-medium text-center">
                    ↑ 12% Performa meningkat bisnis kamu
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Produk 📦</p>
                    <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">{{ $total_produk }}</p>
                </div>
                <a href="{{ route('owner.produk.index') }}" class="text-sm text-red-500 hover:underline">
                    Lihat semua produk →
                </a>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300 flex flex-col justify-between">
                <div>
                    <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Pesanan 🧾</p>
                    <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">{{ $total_pesanan }}</p>
                </div>
               <a href="{{ route('owner.pesanan.index') }}" class="text-sm text-red-500 hover:underline">
                    Lihat semua pesanan →
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 transform hover:scale-[1.01] transition-all duration-300">
                <p class="text-slate-400 font-medium text-xs uppercase tracking-wider">Total Pelanggan 👑</p>
                <p class="text-4xl font-bold mt-2 text-rose-950 font-serif">{{ number_format($total_pelanggan, 0, ',', '.') }}</p>
                <a href="{{ route('owner.pelanggan.index') }}" class="text-sm text-red-500 hover:underline">
                    Lihat rincian pelanggan baru →
                </a>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30">
                <h3 class="font-serif font-bold mb-6 text-xl text-rose-950 flex items-center gap-2">
                    Top Selling Products 💄
                </h3>
                <div class="space-y-4">
                @forelse($top_products as $prod)
                    <div class="flex justify-between items-center border-b border-rose-50 pb-4 hover:bg-rose-50/20 px-2 rounded-xl transition duration-200">
                        <span class="text-slate-700 font-medium text-sm">{{ $prod->nama_produk }} ✨</span>
                        <span class="bg-rose-50 text-rose-600 font-bold text-xs px-4 py-1.5 rounded-full border border-rose-100">
                            {{ $prod->total_terjual }} terjual
                        </span>
                    </div>
                @empty
                    <div class="text-center py-4 text-sm text-slate-400 italic">
                        Belum ada data transaksi produk terjual 🛌
                    </div>
                @endforelse
            </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30 mt-8">
            <h3 class="font-serif font-bold mb-6 text-xl text-rose-950">
                Laporan Penjualan Bulanan 📊
            </h3>
            <div class="max-h-[300px] flex justify-center">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('salesChart');

    // Menerima data array omzet dari Controller secara aman lewat format JSON
    const dataOmzetRiil = @json($bulanan_omzet);

    new Chart(ctx, {
        type: 'bar',
        data: {
            // Label lengkap dari Januari hingga Desember
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Penjualan',
                data: dataOmzetRiil, // ✨ Menggunakan data dinamis dari database Anda
                backgroundColor: '#e11d48',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        // Memformat angka di sumbu Y menjadi mata uang Rupiah secara otomatis
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
    </script>
</body>
</html>