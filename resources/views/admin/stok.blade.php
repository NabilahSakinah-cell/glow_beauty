<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-rose-50/50 text-slate-800 min-h-screen pb-12">

    <div class="bg-white border-b border-rose-100 px-8 py-6 flex items-center justify-between">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-rose-600 hover:text-rose-700 font-bold transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <h1 class="text-2xl font-bold text-rose-950">Stok Barang</h1>
    </div>

    <div class="p-8 max-w-7xl mx-auto">
        
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div class="relative w-full md:w-96">
                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-rose-100 focus:ring-2 focus:ring-rose-200 outline-none transition">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-rose-300"></i>
            </div>
            <a href="{{ route('admin.produk.create') }}" class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-md shadow-rose-200">
                + Tambah Barang
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-rose-50">
                    <tr class="text-rose-900 text-sm uppercase tracking-wider">
                        <th class="py-4 px-6">NO</th>
                        <th class="py-4 px-6">GAMBAR</th>
                        <th class="py-4 px-6">NAMA BARANG</th>
                        <th class="py-4 px-6">STOK</th>
                        <th class="py-4 px-6">HARGA</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-rose-50">
                    @forelse($produk as $index => $item)
                        <tr class="hover:bg-rose-50/50 transition-colors">
                            <td class="py-4 px-6 font-medium">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <img src="{{ asset('uploads/produk/' . ($item->gambar ?? 'default.png')) }}" class="w-12 h-12 rounded-lg object-cover">
                            </td>
                            <td class="py-4 px-6 font-semibold text-rose-950">{{ $item->nama_produk ?? $item->nama }}</td>
                            <td class="py-4 px-6 font-bold text-rose-600">{{ $item->stok ?? 0 }}</td>
                            <td class="py-4 px-6 font-medium">Rp. {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ url('/admin/produk/edit/' . ($item->id ?? $item->id_produk)) }}" class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{ url('/admin/produk/hapus/' . ($item->id ?? $item->id_produk)) }}" class="text-red-400 hover:text-red-600" onclick="return confirm('Hapus?')"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-slate-400">Belum ada data barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>