<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-6 md:p-8 min-h-screen">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-rose-950">Data Semua Pesanan 🧾</h1>
                <p class="text-slate-500 text-sm mt-1">Laporan riwayat transaksi pesanan masuk</p>
            </div>
            <a href="/owner" class="bg-white hover:bg-rose-600 text-rose-600 hover:text-white px-5 py-2 rounded-full border border-rose-200 text-sm font-semibold transition-all duration-200">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/30">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b text-slate-400 text-sm">
                            <th class="text-left p-3 font-medium">ID Pesanan</th>
                            <th class="text-left p-3 font-medium">Tanggal</th>
                            <th class="text-left p-3 font-medium">Total Harga</th>
                            <th class="text-left p-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semua_pesanan as $order)
                        <tr class="border-b hover:bg-slate-50/50 transition">
                            <td class="p-3 font-medium text-slate-700">#ORD{{ str_pad($order->id_pesanan ?? 0, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="p-3 text-slate-500">
                                {{ isset($order->tanggal_pesanan) ? \Carbon\Carbon::parse($order->tanggal_pesanan)->format('d M Y') : '-' }}
                            </td> 
                            <td class="p-3 font-medium text-slate-700">Rp{{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="p-3">
                            @if(strtolower($order->status ?? '') == 'selesai')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-medium">Selesai</span>
                            @elseif(strtolower($order->status ?? '') == 'pending')
                                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-medium">Pending (Diproses)</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">{{ $order->status }}</span>
                            @endif
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-400 text-sm italic">Belum ada data pesanan di database 🛌</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>