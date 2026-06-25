<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                   <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-200 bg-gray-50">
                            <th class="p-3">ID Pesanan</th>
                            <th class="p-3">Tanggal Checkout</th>
                            <th class="p-3 text-right">Total Belanja</th>
                            <th class="p-3 text-center">Status Pemesanan</th>
                            <th class="p-3 text-center">Aksi</th> </tr>
                    </thead>

                    <tbody>
                    @forelse ($orders as $order)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="p-3 font-semibold text-gray-700">#{{ $order->id }}</td>
                        <td class="p-3 text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="p-3 text-right font-bold text-gray-800">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        
                        <td class="p-3 text-center">
                            {{-- Status Badge: Dibuat case-insensitive --}}
                            <span class="px-3 py-1 rounded-full text-sm font-bold shadow-sm {{ strtolower(trim($order->status)) == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td class="p-3 text-center">
                            {{-- Tombol Rating: Dibuat case-insensitive --}}
                            @if(strtolower(trim($order->status)) == 'selesai')
                                <button onclick="bukaRating({{$order->id}}, {{ $order->produk_id ?? 0 }})" class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                    Beri Rating
                                </button>
                            @else
                                <span class="text-gray-400 text-sm italic">Belum tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Anda belum memiliki riwayat pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
                <div id="modal-rating" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-2xl w-96 shadow-xl">
                        <h2 class="text-xl font-bold mb-4 text-gray-800">Beri Ulasan</h2>
                        
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pesanan_id" id="modal_pesanan_id">
                            <input type="hidden" name="produk_id" id="modal_produk_id">

                            <label class="block mb-2 font-medium">Rating (1-5):</label>
                            <select name="rating" class="w-full border rounded-lg p-2 mb-4" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Kurang)</option>
                                <option value="1">⭐ (Sangat Kurang)</option>
                            </select>

                            <label class="block mb-2 font-medium">Ulasan:</label>
                            <textarea name="ulasan" class="w-full border rounded-lg p-2 mb-4 h-24" placeholder="Tulis pengalamanmu..." required></textarea>

                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="tutupRating()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                  function bukaRating(pesananId, produkId) {
                        // Menampilkan modal dengan menghapus class 'hidden'
                        document.getElementById('modal-rating').classList.remove('hidden');
                        document.getElementById('modal-rating').classList.add('flex');
                        
                       // Mengisi ID Pesanan dan ID Produk ke dalam form
                        document.getElementById('modal_pesanan_id').value = pesananId;
                        document.getElementById('modal_produk_id').value = produkId;
                    }

                    function tutupRating() {
                        // Menyembunyikan modal dengan menambah class 'hidden'
                        document.getElementById('modal-rating').classList.add('hidden');
                        document.getElementById('modal-rating').classList.remove('flex');
                    }
                </script>
</x-app-layout>