<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - Admin Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-8 min-h-screen">

    <div class="max-w-6xl mx-auto animate-fade-in">
        
        <div class="mb-8">
            <a href="/admin/dashboard" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium transform hover:-translate-x-1 duration-200 mb-2">
                &larr; Kembali ke Dashboard
            </a>
            <h2 class="text-3xl font-bold text-rose-950">Daftar Pesanan Masuk 📦</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau list pesanan masuk dari pelanggan dan kelola status pengirimannya.</p>
        </div>

        <div class="bg-white rounded-3xl overflow-hidden border border-rose-100 shadow-xl shadow-rose-100/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-rose-50 text-rose-900 font-semibold text-sm">
                            <th class="p-4 border-b border-rose-100 text-center w-16">No</th>
                            <th class="p-4 border-b border-rose-100">Nota</th>
                            <th class="p-4 border-b border-rose-100">Pelanggan</th>
                            <th class="p-4 border-b border-rose-100">Total Bayar</th>
                            <th class="p-4 border-b border-rose-100 text-center">Status</th>
                            <th class="p-4 border-b border-rose-100 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-rose-50 text-sm">
                        @forelse($pesanan as $index => $item)
                        <tr class="hover:bg-rose-50/30 transition-colors duration-200">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4 font-semibold text-rose-950">#TRX{{ $item->id_pesanan ?? '000' }}</td>
                            <td class="p-4 font-medium text-slate-800">{{ $item->nama_pelanggan ?? 'Nama Pelanggan' }}</td>
                            <td class="p-4 font-bold text-rose-600">Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="p-4 text-center">
                                <span class="bg-amber-50 text-amber-700 text-xs px-3 py-1 rounded-full font-medium border border-amber-100">
                                    {{ $item->status ?? 'Pending' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white px-3 py-1.5 rounded-lg border border-rose-200 transition-all duration-200 font-medium text-xs shadow-sm">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400 italic">
                                Belum ada pesanan masuk saat ini. ✨
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