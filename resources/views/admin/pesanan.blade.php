<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - Admin Glow Beauty</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>

</head>

<body class="bg-rose-50/50 text-slate-800 p-8 min-h-screen">

<div class="max-w-7xl mx-auto animate-fade-in">

    <!-- Header -->
    <div class="mb-8">

        <a href="/admin/dashboard"
           class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium transform hover:-translate-x-1 duration-200 mb-2">
            &larr; Kembali ke Dashboard
        </a>

        <h2 class="text-3xl font-bold text-rose-950">
            Daftar Pesanan Masuk 📦
        </h2>

        <p class="text-slate-500 text-sm mt-1">
            Pantau list pesanan masuk dari pelanggan dan kelola status pengirimannya.
        </p>

    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-yellow-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pesanan Baru</p>
                    <h3 class="text-3xl font-bold text-yellow-500">{{ $stats['baru'] }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-xl text-2xl">📋</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-blue-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Diproses</p>
                    <h3 class="text-3xl font-bold text-blue-500">{{ $stats['proses'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl text-2xl">📦</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-pink-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Dikirim</p>
                    <h3 class="text-3xl font-bold text-pink-500">{{ $stats['dikirim'] }}</h3>
                </div>
                <div class="bg-pink-100 p-3 rounded-xl text-2xl">🚚</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-green-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Selesai</p>
                    <h3 class="text-3xl font-bold text-green-500">{{ $stats['selesai'] }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-xl text-2xl">✔️</div>
            </div>
        </div>
    </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-3xl p-5 mb-6 border border-rose-100 shadow-lg">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input
                type="text"
                placeholder="🔍 Cari ID Pesanan atau Nama Pelanggan..."
                class="border border-rose-200 rounded-xl p-3 focus:ring-2 focus:ring-rose-300 focus:outline-none">

            <select
                class="border border-rose-200 rounded-xl p-3 focus:ring-2 focus:ring-rose-300 focus:outline-none">
                <option>Semua Status</option>
                <option>Pending</option>
                <option>Diproses</option>
                <option>Dikirim</option>
                <option>Selesai</option>
            </select>

            <input
                type="date"
                class="border border-rose-200 rounded-xl p-3 focus:ring-2 focus:ring-rose-300 focus:outline-none">

            <button
                class="bg-rose-500 hover:bg-rose-600 text-white rounded-xl font-semibold transition-all duration-200 shadow-md">
                📊 Export Data
            </button>

        </div>

    </div>

    <!-- Tabel Pesanan -->
    <div class="bg-white rounded-3xl overflow-hidden border border-rose-100 shadow-xl shadow-rose-100/50">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>

                <tr class="bg-rose-50 text-rose-900 font-semibold text-sm">

                    <th class="p-4 border-b border-rose-100 text-center w-16">
                        Nomor
                    </th>

                    <th class="p-4 border-b border-rose-100">
                        Nota
                    </th>

                    <th class="p-4 border-b border-rose-100">
                        Pelanggan
                    </th>

                    <th class="p-4 border-b border-rose-100">
                        Total Bayar
                    </th>

                    <th class="p-4 border-b border-rose-100 text-center">
                        Status
                    </th>

                    <th class="p-4 border-b border-rose-100 text-center w-40">
                        Aksi
                    </th>

                </tr>

                </thead>

                <tbody class="divide-y divide-rose-50 text-sm">

                @forelse($pesanan as $index => $item)

                    <tr class="hover:bg-rose-50/30 transition-colors duration-200">

                        <td class="p-4 text-center font-medium text-slate-400">
                            {{ $index + 1 }}
                        </td>

                        <td class="p-4 font-semibold text-rose-950">
                            #TRX{{ $item->id_pesanan ?? '000' }}
                        </td>

                        <td class="p-4 font-medium text-slate-800">
                            ID Pelanggan: {{ $item->id_pelanggan }}
                        </td>

                        <td class="p-4 font-bold text-rose-600">
                            Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="p-4 text-center">

                            <span class="bg-amber-50 text-amber-700 text-xs px-3 py-1 rounded-full font-medium border border-amber-100">
                                Pending
                            </span>

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                <button class="bg-rose-100 hover:bg-rose-500 hover:text-white text-rose-600 px-3 py-2 rounded-lg text-xs font-semibold transition">
                                    Detail
                                </button>

                                <button class="bg-blue-100 hover:bg-blue-500 hover:text-white text-blue-600 px-3 py-2 rounded-lg text-xs font-semibold transition">
                                    Update
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="p-8 text-center text-slate-400 italic bg-rose-50/10">

                            Belum ada pesanan masuk saat ini.
                            Belanjaan pelanggan akan muncul di sini! ✨

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>