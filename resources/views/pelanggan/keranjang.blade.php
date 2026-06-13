<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-rose-50/30 min-h-screen p-4 md:p-8">

    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-rose-950 mb-6">Keranjang Belanja Anda ✨</h1>

        <div class="bg-white rounded-2xl shadow-sm border border-rose-100 overflow-hidden">
            <div class="grid grid-cols-12 gap-4 p-4 border-b border-rose-50 text-sm font-semibold text-rose-600 bg-rose-50/50">
                <div class="col-span-6">Produk</div>
                <div class="col-span-2 text-center">Harga</div>
                <div class="col-span-2 text-center">Jumlah</div>
                <div class="col-span-2 text-center">Subtotal</div>
            </div>

            @foreach($keranjang as $item)
            <div class="grid grid-cols-12 gap-4 items-center border-b p-4">
                <div class="col-span-6 font-bold flex items-center gap-4">
                    <img src="{{ asset('uploads/produk/' . $item->gambar) }}" class="w-12 h-12 object-cover rounded-lg">
                    {{ $item->nama_produk }}
                </div>
                <div class="col-span-2 text-center">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                
                <div class="col-span-2 text-center">
                    {{ $item->total_jumlah }}
                </div>        
                
                <div class="col-span-2 text-center font-bold text-rose-600">
                    Rp {{ number_format($item->harga * $item->total_jumlah, 0, ',', '.') }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6 bg-white p-6 rounded-2xl shadow-sm border border-rose-100 flex justify-between items-center">
            <a href="{{ route('pelanggan.dashboard') }}" class="text-rose-600 font-semibold hover:text-rose-700 flex items-center gap-2 transition">
                <i class="fa-solid fa-arrow-left"></i> Lanjut Belanja
            </a>
            
            <div class="flex items-center gap-8">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Total Pembayaran</p>
                    <p class="text-2xl font-bold text-rose-600">
                        Rp {{ number_format($keranjang->sum(fn($item) => $item->harga * $item->total_jumlah), 0, ',', '.') }}
                    </p>
                </div>
                
                <form action="{{ route('keranjang.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-10 py-3 rounded-xl font-bold uppercase tracking-wide transition shadow-lg shadow-rose-200">
                        Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>