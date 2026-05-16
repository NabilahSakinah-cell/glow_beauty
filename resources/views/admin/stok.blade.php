<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok - Admin Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-8 min-h-screen">

    <div class="max-w-6xl mx-auto animate-fade-in">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <a href="/admin/dashboard" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium transform hover:-translate-x-1 duration-200 mb-2">
                    &larr; Kembali ke Dashboard
                </a>
                <h2 class="text-3xl font-bold text-rose-950">Atur Stok Barang 📦</h2>
                <p class="text-slate-500 text-sm mt-1">Pantau ketersediaan real-time dan sesuaikan persediaan kosmetik Anda.</p>
            </div>
            
            <div class="bg-white border border-rose-100 px-4 py-2.5 rounded-2xl shadow-sm flex items-center gap-3">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                </span>
                <span class="text-xs font-semibold text-rose-950">Sistem Stok Terintegrasi</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl overflow-hidden border border-rose-100 shadow-xl shadow-rose-100/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-rose-50 text-rose-900 font-semibold text-sm">
                            <th class="p-4 border-b border-rose-100 text-center w-16">No</th>
                            <th class="p-4 border-b border-rose-100">Gambar</th>
                            <th class="p-4 border-b border-rose-100">Nama Produk</th>
                            <th class="p-4 border-b border-rose-100">Kategori</th>
                            <th class="p-4 border-b border-rose-100 text-center w-36">Status Stok</th>
                            <th class="p-4 border-b border-rose-100 text-center w-28">Jumlah Stok</th>
                            <th class="p-4 border-b border-rose-100 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-rose-50 text-sm">
                        @forelse($produk as $index => $item)
                        <tr class="hover:bg-rose-50/30 transition-colors duration-200">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="Gambar" class="w-12 h-12 object-cover rounded-xl border border-rose-100 shadow-sm">
                            </td>
                            <td class="p-4 font-semibold text-slate-800">{{ $item->nama_produk }}</td>
                            <td class="p-4">
                                <span class="text-xs text-slate-500 font-medium bg-slate-100 px-2.5 py-1 rounded-md">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @if($item->stok == 0)
                                    <span class="bg-red-50 text-red-600 border border-red-100 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">Habis ❌</span>
                                @elif($item->stok < 10)
                                    <span class="bg-amber-50 text-amber-600 border border-amber-100 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">Menipis ⚠️</span>
                                @else
                                    <span class="bg-green-50 text-green-600 border border-green-100 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider">Aman ✅</span>
                                @endif
                            </td>
                            <td class="p-4 text-center font-bold text-base text-slate-700">
                                {{ $item->stok }} <span class="text-xs font-normal text-slate-400">pcs</span>
                            </td>
                            <td class="p-4 text-center">
                                <a href="/admin/produk/edit/{{ $item->id_produk }}" class="inline-flex items-center gap-1.5 bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition duration-200 shadow-sm active:scale-95">
                                    ✏️ Sesuaikan
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400 italic">
                                Belum ada data produk kosmetik yang tersedia.
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