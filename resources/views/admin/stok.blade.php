<x-app-layout> 
    <div class="min-h-screen bg-white font-sans pb-12">
        
        <div class="pt-6 px-8 flex items-center gap-4 text-pink-700">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 hover:opacity-70 transition-opacity" title="Kembali ke Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </a>
        </div>

        <div class="px-8 mt-4">
            <div class="text-sm text-gray-500 mb-2 font-medium">
                Beranda <span class="mx-1">></span> Daftar <span class="mx-1">></span> Produk Kosmetik
            </div>

            <h1 class="text-3xl font-extrabold text-pink-800 mb-8 tracking-wide">
                Stok Barang
            </h1>

            <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                <div class="text-lg font-medium text-gray-700">Cari Barang</div>
                
                <div class="flex flex-wrap items-center gap-4 flex-1 justify-end">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600 font-medium text-sm">Kategori</span>
                        <select class="border-none text-pink-700 font-bold text-base focus:ring-0 cursor-pointer bg-transparent outline-none">
                            <option>Semua</option>
                            <option>Lipstik</option>
                            <option>Bedak</option>
                            <option>Skincare</option>
                        </select>
                    </div>

                    <div class="relative w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-pink-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </span>
                        <input type="text" placeholder="Ketik nama produk..." class="w-full border border-pink-300 rounded-lg pl-10 pr-10 py-2 focus:ring-pink-500 focus:border-pink-500 text-gray-700 placeholder-pink-300 outline-none transition bg-white">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-pink-400 cursor-pointer hover:text-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                        </span>
                    </div>

                    <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-xs transition tracking-wide text-sm">
                        Cari
                    </button>
                    <a href="{{ route('admin.produk.create') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-lg font-bold shadow-xs transition tracking-wide text-sm">
                        Tambah Barang
                    </a>
                </div>
            </div>

            <div class="border border-pink-200 rounded-xl overflow-hidden bg-white shadow-xs">
                <table class="w-full text-center border-collapse">
                    <thead class="bg-white border-b border-pink-200">
                        <tr class="text-pink-950 text-sm font-bold tracking-wide">
                            <th class="py-5 px-4 border-r border-pink-200 w-16">NO</th>
                            <th class="py-5 px-4 border-r border-pink-200 w-28">GAMBAR</th>
                            <th class="py-5 px-4 border-r border-pink-200">Nama Barang</th>
                            <th class="py-5 px-4 border-r border-pink-200">Kategori</th>
                            <th class="py-5 px-4 border-r border-pink-200">Harga</th>
                            <th class="py-5 px-4 border-r border-pink-200 w-24">Stock</th>
                            <th class="py-5 px-4 border-r border-pink-200 w-32">Status</th>
                            <th class="py-5 px-4 w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $index => $item)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-pink-50/20' }} border-b border-pink-200 hover:bg-pink-100/30 transition-colors">
                                
                                <td class="py-4 px-4 border-r border-pink-200 text-gray-700 font-medium text-base">
                                    {{ $index + 1 }}
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200">
                                    <div class="flex justify-center">
                                        <img src="{{ asset('uploads/produk/' . ($item->gambar ?? $item->foto ?? 'default.png')) }}" alt="Foto" class="w-14 h-14 object-cover rounded-lg border border-pink-100 shadow-2xs">
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200 font-semibold text-gray-800 text-base">
                                    {{ $item->nama_produk ?? $item->nama ?? 'Produk Tanpa Nama' }}
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200">
                                    <span class="bg-pink-600 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-wider shadow-2xs">
                                        {{ $item->kategori ?? 'Kosmetik' }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200 font-medium text-gray-700 text-base">
                                    Rp. {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200 font-bold text-gray-800 text-base">
                                    {{ $item->stok ?? 0 }}
                                </td>
                                
                                <td class="py-4 px-4 border-r border-pink-200">
                                    @if(($item->stok ?? 0) > 0)
                                        <span class="bg-pink-500 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-wider shadow-2xs">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="bg-gray-400 text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-wider shadow-2xs">
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                <td class="py-4 px-4">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ url('/admin/produk/edit/' . ($item->id ?? $item->id_produk)) }}" class="p-2 rounded bg-white border border-pink-200 text-pink-600 hover:bg-pink-600 hover:text-white transition shadow-2xs" title="Edit Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <a href="{{ url('/admin/produk/hapus/' . ($item->id ?? $item->id_produk)) }}" class="p-2 rounded bg-white border border-pink-200 text-rose-600 hover:bg-rose-600 hover:text-white transition shadow-2xs" onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus Data">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-pink-300 bg-white font-medium text-base">
                                    📭 Belum ada data kosmetik di database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>