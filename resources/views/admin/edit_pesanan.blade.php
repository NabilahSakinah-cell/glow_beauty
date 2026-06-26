<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan #{{ $pesanan->id_pesanan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; background-color: #fdf8f8; } </style>
</head>
<body class="text-[#3b2a2a] p-8">

    <div class="max-w-5xl mx-auto">
        <a href="{{ url('/admin/pesanan') }}" class="inline-flex items-center text-[#E11D48] hover:text-[#BE123C] font-medium mb-6 transition-colors text-lg">
            &larr; Kembali ke Daftar Pesanan
        </a>

        <div class="mb-8">
            <h1 class="text-4xl font-extrabold flex items-center gap-3 text-[#3B1C1A] tracking-wide">
                <span class="text-4xl">✏️</span> Edit Pesanan #{{ $pesanan->id_pesanan }}
            </h1>
        </div>

        <form action="{{ url('/admin/pesanan/update/' . $pesanan->id_pesanan) }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium mb-2">ID Pelanggan</label>
                    <input type="text" value="{{ $pesanan->id_pelanggan }}" readonly class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 focus:outline-none cursor-not-allowed">
                </div>

                <div>
                   <label class="block text-sm font-medium mb-2">Status Pesanan</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg p-2.5 bg-white">
                    <option value="Pending" {{ $pesanan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Dikirim" {{ $pesanan->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                </div>
            </div>

            <div class="mb-8 overflow-x-auto">
                <h3 class="text-sm font-bold mb-4">Item Pesanan</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-y border-gray-200 bg-gray-50/50">
                            <th class="py-3 px-2 text-sm">Produk ID</th>
                            <th class="py-3 px-2 text-sm">Jumlah (Qty)</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($items as $item)
                        <tr class="border-b border-gray-100">
                            <td class="py-4 px-2">{{ $item->id_produk }}</td>
                            <td class="py-4 px-2">
                                <input type="number" name="items[{{ $item->id_detail_pesanan }}][jumlah]" value="{{ $item->jumlah }}" class="w-16 border border-gray-300 rounded p-1 text-center">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Alamat Pengiriman</label>
                <textarea name="alamat" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-[#591d1d]" rows="2">{{ $pesanan->alamat }}</textarea>
            </div>

            <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                <a href="{{ url('/admin/pesanan') }}" class="bg-[#F1F5F9] text-[#334155] px-8 py-3 rounded-xl font-semibold">Batal</a>
                <button type="submit" class="bg-[#E11D48] text-white px-8 py-3 rounded-xl font-semibold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>