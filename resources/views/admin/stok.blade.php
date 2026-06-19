<x-app-layout>
    <div class="p-8 max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-rose-950">Stok Barang</h1>
            <a href="{{ route('admin.produk.create') }}" class="bg-rose-600 text-white px-6 py-3 rounded-xl font-bold">
                + Tambah Barang
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-rose-50">
                    <tr class="text-rose-900 text-sm uppercase">
                        <th class="py-4 px-6">NO</th>
                        <th class="py-4 px-6">GAMBAR</th>
                        <th class="py-4 px-6">NAMA BARANG</th>
                        <th class="py-4 px-6">STOK</th>
                        <th class="py-4 px-6">HARGA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-rose-50">
                    @forelse($produk as $index => $item)
                        <tr>
                            <td class="py-4 px-6">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <img src="{{ asset('uploads/produk/' . ($item->gambar ?? 'default.png')) }}" class="w-12 h-12 rounded-lg object-cover">
                            </td>
                            <td class="py-4 px-6">{{ $item->nama_produk ?? $item->nama }}</td>
                            <td class="py-4 px-6">{{ $item->stok ?? 0 }}</td>
                            <td class="py-4 px-6">Rp. {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-10 text-center">Data kosong.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>git reset --soft HEAD~1