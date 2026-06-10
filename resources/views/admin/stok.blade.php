<x-app-layout> @php
        // 🧠 LOGIKA OTOMATIS: Menghitung ringkasan stok langsung dari database MySQL
        $totalProduk = $produk->count();
        $stokAman = $produk->where('stok', '>=', 10)->count();
        $stokMenipis = $produk->whereBetween('stok', [1, 9])->count();
        $stokHabis = $produk->where('stok', '<=', 0)->count();
    @endphp

    <div class="p-6 bg-gray-50 min-h-screen font-sans">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Stok Barang 📦</h1>
                <p class="text-gray-500 mt-1">Pantau, tambah, dan perbarui persediaan produk kecantikan secara akurat.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('admin.produk.create') }}" class="flex-1 md:flex-none text-center bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl font-semibold transition-all shadow-sm flex items-center justify-center gap-2">
                    <span class="text-lg font-bold">+</span> Tambah Produk Baru
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="bg-pink-50 p-4 rounded-2xl text-pink-500 text-2xl flex items-center justify-center w-14 h-14">
                    ✨
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Total Produk</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $totalProduk }}</p>
                    <span class="text-[11px] text-gray-400 font-medium">Item terdaftar</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="bg-emerald-50 p-4 rounded-2xl text-emerald-500 text-2xl flex items-center justify-center w-14 h-14">
                    💚
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Stok Aman</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $stokAman }}</p>
                    <span class="text-[11px] text-emerald-600 font-semibold bg-emerald-50 px-1.5 py-0.5 rounded">≥ 10 pcs</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="bg-amber-50 p-4 rounded-2xl text-amber-500 text-2xl flex items-center justify-center w-14 h-14">
                    💛
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Stok Menipis</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $stokMenipis }}</p>
                    <span class="text-[11px] text-amber-600 font-semibold bg-amber-50 px-1.5 py-0.5 rounded">1 - 9 pcs</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="bg-rose-50 p-4 rounded-2xl text-rose-500 text-2xl flex items-center justify-center w-14 h-14">
                    💔
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider">Stok Habis</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $stokHabis }}</p>
                    <span class="text-[11px] text-rose-600 font-semibold bg-rose-50 px-1.5 py-0.5 rounded">0 pcs</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-pink-50/40 text-pink-900 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                            <th class="py-4 px-6 text-center w-16">No</th>
                            <th class="py-4 px-6 w-24">Gambar</th>
                            <th class="py-4 px-6">Nama Kosmetik / Produk</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6">Harga Satuan</th>
                            <th class="py-4 px-6 text-center w-32">Jumlah Stok</th>
                            <th class="py-4 px-6 text-center w-36">Status Indikator</th>
                            <th class="py-4 px-6 text-center w-40">Tindakan / Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($produk as $index => $item)
                            <tr class="hover:bg-pink-50/10 transition-colors">
                                <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                                
                                <td class="py-4 px-6">
                                    @if(isset($item->gambar) && $item->gambar)
                                        <img src="{{ asset('uploads/produk/' . $item->gambar) }}" alt="Produk" class="w-14 h-14 rounded-xl object-cover border border-gray-100 shadow-sm">
                                    @elseif(isset($item->foto) && $item->foto)
                                        <img src="{{ asset('uploads/produk/' . $item->foto) }}" alt="Produk" class="w-14 h-14 rounded-xl object-cover border border-gray-100 shadow-sm">
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-gray-50 flex items-center justify-center text-[10px] text-gray-400 border border-dashed border-gray-200">No Pic</div>
                                    @endif
                                </td>

                                <td class="py-4 px-6 font-semibold text-gray-800">
                                    {{ $item->nama_produk ?? $item->nama ?? 'Produk Tanpa Nama' }}
                                </td>

                                <td class="py-4 px-6">
                                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs font-semibold tracking-wide">
                                        {{ $item->kategori ?? 'Umum' }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 font-bold text-gray-700">
                                    Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                </td>
                                
                                <td class="py-4 px-6 text-center font-extrabold text-base">
                                    <span class="{{ ($item->stok ?? 0) >= 10 ? 'text-emerald-600' : (($item->stok ?? 0) > 0 ? 'text-amber-500' : 'text-rose-600') }}">
                                        {{ $item->stok ?? 0 }} <span class="text-xs text-gray-400 font-normal">pcs</span>
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-center">
                                    @if(($item->stok ?? 0) >= 10)
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-bold border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AMAN
                                        </span>
                                    @elseif(($item->stok ?? 0) > 0)
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-md text-xs font-bold border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> MENIPIS
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 px-2.5 py-1 rounded-md text-xs font-bold border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> HABIS
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-6 text-center">
                                    <div class="inline-flex items-center justify-center gap-1.5">
                                        <a href="{{ url('/admin/stok/tambah/' . ($item->id ?? $item->id_produk)) }}" class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200 font-bold flex items-center justify-center transition-all text-sm shadow-2xs" title="Tambah 1 Stok">
                                            +
                                        </a>
                                        
                                        <a href="{{ url('/admin/stok/kurang/' . ($item->id ?? $item->id_produk)) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white border border-amber-200 font-bold flex items-center justify-center transition-all text-sm shadow-2xs" title="Kurangi 1 Stok">
                                            -
                                        </a>
                                        
                                        <a href="{{ url('/admin/produk/edit/' . ($item->id ?? $item->id_produk)) }}" class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white border border-sky-200 flex items-center justify-center transition-all shadow-2xs" title="Edit Rincian">
                                            ✏️
                                        </a>
                                        
                                        <a href="{{ url('/admin/produk/hapus/' . ($item->id ?? $item->id_produk)) }}" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white border border-rose-200 flex items-center justify-center transition-all shadow-2xs" title="Hapus Produk" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini dari database?')">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-gray-400 bg-white font-medium">
                                    📭 Belum ada data kosmetik di database. Silakan klik "Tambah Produk Baru" untuk mengisi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>