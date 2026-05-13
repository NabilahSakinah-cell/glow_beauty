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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-700">
                                    #{{ $order->id }}
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="p-3 text-right font-bold text-gray-800">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="p-3 text-center">
                                    {{-- Pewarnaan Status Dinamis --}}
                                    @if($order->status == 'Menunggu Pembayaran' || $order->status == 'Pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif($order->status == 'Diproses')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                            Pesanan Diproses
                                        </span>
                                    @elseif($order->status == 'Selesai')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                            Pesanan Selesai
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                                            {{ $order->status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500">
                                    <p class="mb-2">Anda belum memiliki riwayat pesanan.</p>
                                    <a href="{{ url('/') }}" class="text-blue-500 hover:underline font-semibold">Ayo mulai belanja!</a>
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