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

            @forelse($keranjang as $item)
            <div class="grid grid-cols-12 gap-4 items-center border-b p-4">
                <div class="col-span-6 font-bold flex items-center gap-4">
                    <img src="{{ asset('uploads/produk/' . ($item->gambar ?? $item->foto ?? 'default.png')) }}" 
                         class="w-12 h-12 object-cover rounded-lg" 
                         onerror="this.onerror=null;this.src='{{ asset('uploads/produk/default.png') }}';">
                    <span>{{ $item->nama_produk }}</span>
                </div>
                <div class="col-span-2 text-center">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </div>
                
                <div class="col-span-2 flex items-center justify-center gap-2">
                    <form action="{{ route('keranjang.update', $item->id_detail_keranjang) }}" method="POST">
                        @csrf
                        <input type="hidden" name="aksi" value="kurang">
                        <button type="submit" class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 hover:bg-rose-200">-</button>
                    </form>
                    
                    <span class="font-bold w-6 text-center">{{ $item->jumlah }}</span>
                    
                    <form action="{{ route('keranjang.update', $item->id_detail_keranjang) }}" method="POST">
                        @csrf
                        <input type="hidden" name="aksi" value="tambah">
                        <button type="submit" class="w-8 h-8 rounded-full bg-rose-600 text-white hover:bg-rose-700">+</button>
                    </form>
                </div>

                <div class="col-span-2 text-center font-bold text-rose-600">
                    Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                </div>
            </div>
            @empty
            <div class="p-10 text-center text-gray-500">
                <i class="fa-solid fa-cart-shopping text-4xl mb-4 opacity-20"></i>
                <p>Keranjang Anda masih kosong. Yuk, belanja sekarang!</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6 bg-white p-6 rounded-2xl shadow-sm border border-rose-100 flex justify-between items-center">
    <a href="{{ route('pelanggan.dashboard') }}" class="text-rose-600 font-semibold hover:text-rose-700 flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i> Lanjut Belanja
    </a>
    
    <div class="flex items-center gap-8">
        <div class="text-right">
            <p class="text-sm text-gray-500">Total Pembayaran</p>
            <p class="text-2xl font-bold text-rose-600">
                Rp {{ number_format($keranjang->sum(fn($item) => $item->harga * $item->jumlah), 0, ',', '.') }}
            </p>
        </div>
        
        <form action="{{ route('keranjang.checkout') }}" method="POST">
            @csrf
            <a href="{{ route('keranjang.checkout.form') }}" 
            class="bg-rose-600 hover:bg-rose-700 text-white px-10 py-3 rounded-xl font-bold uppercase tracking-wide transition shadow-lg shadow-rose-200 block text-center">
            Checkout
        </a>
        </form>
    </div>
</div>
</body>
</html>