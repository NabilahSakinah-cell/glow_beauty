<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 p-3 text-sm">ID Order</th>
                                <th class="border border-gray-300 p-3 text-sm">Pelanggan</th>
                                <th class="border border-gray-300 p-3 text-sm">Tanggal</th>
                                <th class="border border-gray-300 p-3 text-sm">Total Belanja</th>
                                <th class="border border-gray-300 p-3 text-sm">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="text-center hover:bg-gray-50 transition">
                                <td class="border border-gray-300 p-2 font-bold">#{{ $order->id }}</td>
                                <td class="border border-gray-300 p-2">{{ $order->user->name ?? 'User Dihapus' }}</td>
                                <td class="border border-gray-300 p-2">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                {{-- Ganti 'total_harga' di bawah ini dengan nama kolom di database Anda jika berbeda --}}
                                <td class="border border-gray-300 p-2">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 p-2">
                                    {{-- Form Ubah Status Langsung di Tabel --}}
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf @method('PUT')
                                        <select name="status" class="border-gray-300 rounded text-sm">
                                            <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                            <option value="Sedang Diproses" {{ $order->status == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                            <option value="Dikirim" {{ $order->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border border-gray-300 p-6 text-center text-gray-500 italic">
                                    Belum ada pesanan masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>