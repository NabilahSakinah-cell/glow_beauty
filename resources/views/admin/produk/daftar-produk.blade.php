<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Admin Glow Beauty</title>
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
                <h2 class="text-3xl font-bold text-rose-950">Daftar Produk Kosmetik 💄</h2>
                <p class="text-slate-500 text-sm mt-1">Kelola data, edit harga stok, atau hapus item kosmetik di toko.</p>
            </div>
            <a href="/admin/produk" class="bg-rose-600 hover:bg-rose-700 text-white px-5 py-3 rounded-xl font-semibold text-sm transition duration-300 transform active:scale-95 shadow-md shadow-rose-200 flex items-center gap-2">
                + Tambah Produk Baru
            </a>
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
                            <th class="p-4 border-b border-rose-100">Harga</th>
                            <th class="p-4 border-b border-rose-100 text-center w-24">Stok</th>
                            <th class="p-4 border-b border-rose-100 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-rose-50 text-sm">
                        @foreach($produk as $index => $item)
                        <tr class="hover:bg-rose-50/30 transition-colors duration-200">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4">
                                <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="Gambar Produk" class="w-14 h-14 object-cover rounded-2xl border border-rose-100 shadow-sm transition-transform duration-300 hover:scale-110">
                            </td>
                            <td class="p-4 font-semibold text-slate-800">{{ $item->nama_produk }}</td>
                            <td class="p-4">
                                <span class="bg-rose-50 text-rose-700 text-xs px-3 py-1 rounded-full font-medium border border-rose-100">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="p-4 font-bold text-rose-600">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="p-4 text-center font-semibold {{ $item->stok < 10 ? 'text-red-500 bg-red-50/50 rounded-lg' : 'text-slate-700' }}">{{ $item->stok }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="/admin/produk/edit/{{ $item->id_produk }}" class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white px-3 py-1.5 rounded-lg border border-amber-200 transition-all duration-200 font-medium text-xs shadow-sm">
                                        Edit
                                    </a>
                                    <a href="/admin/produk/hapus/{{ $item->id_produk }}" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-3 py-1.5 rounded-lg border border-red-200 transition-all duration-200 font-medium text-xs shadow-sm">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</body>
</html>