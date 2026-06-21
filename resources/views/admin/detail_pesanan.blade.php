<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->id_pesanan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #fdf8f8; } </style>
</head>
<body class="text-slate-800 p-8">

    <div class="max-w-4xl mx-auto">
        <a href="{{ url('/admin/pesanan') }}" class="text-rose-600 hover:text-rose-700 font-medium mb-6 inline-block">&larr; Kembali ke Daftar Pesanan</a>

        <div class="bg-white rounded-3xl shadow-sm border border-rose-100 p-8">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-rose-950">Pesanan #{{ $pesanan->id_pesanan }}</h1>
                    <p class="text-slate-500">Detail informasi pesanan pelanggan</p>
                </div>
                <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-rose-100 text-rose-700 uppercase">
                    {{ $pesanan->status }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <h3 class="font-bold text-rose-900 border-b pb-2">Informasi Pelanggan</h3>
                    <p><span class="text-slate-500">ID Pelanggan:</span> {{ $pesanan->id_pelanggan }}</p>
                    <p><span class="text-slate-500">No. Telepon:</span> {{ $pesanan->no_telepon }}</p>
                </div>
                <div class="space-y-4">
                    <h3 class="font-bold text-rose-900 border-b pb-2">Pengiriman</h3>
                    <p><span class="text-slate-500">Alamat:</span><br>{{ $pesanan->alamat }}</p>
                </div>
            </div>

            <h3 class="font-bold text-rose-900 mb-4">Item yang Dipesan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-rose-50 text-rose-900 text-sm">
                        <tr>
                            <th class="p-3 rounded-l-lg">ID Produk</th>
                            <th class="p-3 text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-rose-50">
                        @foreach($items as $item)
                        <tr>
                            <td class="p-3 font-medium">{{ $item->id_produk }}</td>
                            <td class="p-3 text-center">{{ $item->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 pt-6 border-t border-rose-100 flex justify-end">
                <div class="text-right">
                    <p class="text-slate-500 text-sm">Total Pembayaran</p>
                    <h2 class="text-2xl font-bold text-rose-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>