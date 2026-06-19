<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kosmetik - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-rose-50/30 text-slate-800 min-h-screen">

    <div class="bg-white border-b border-rose-100 p-4 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-rose-600">Glow Beauty</h1>
            <div class="flex items-center gap-6">
                <span class="text-sm text-gray-600">Halo, Pelanggan ✨</span>
                
                <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white px-4 py-1.5 rounded-full text-xs font-semibold transition">
            Logout
        </button>
    </form>
    <a href="{{ route('keranjang.index') }}" 
    class="text-rose-600 hover:text-rose-800 transition-all duration-300 p-2">
    <i class="fa-solid fa-cart-shopping text-xl"></i>
</a>
</div>
        </div>
    </div>

    <div class="p-8 max-w-7xl mx-auto">
        <div class="bg-gradient-to-r from-rose-400 to-pink-500 p-8 rounded-3xl text-white mb-10 shadow-md">
            <h2 class="text-3xl font-bold mb-2">Belanja Produk Favoritmu ✨</h2>
            <p class="text-rose-100 text-sm">Dapatkan diskon eksklusif khusus member Glow Beauty hari ini.</p>
        </div>

        <h2 class="text-xl font-bold mb-6 text-rose-950">Katalog Produk Terpopuler</h2>
        
        <form action="{{ route('pelanggan.dashboard') }}" method="GET" class="flex gap-2 mb-6">
    <input type="text" 
           name="search" 
           value="{{ request('search') }}" 
           placeholder="Cari produk..." 
           class="border border-rose-200 rounded-xl px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-rose-300">
           
    <button type="submit" class="bg-rose-600 text-white px-6 py-2 rounded-xl hover:bg-rose-700 transition">
        Cari
    </button>
</form>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @if(isset($produk) && count($produk) > 0)
                @foreach($produk as $item)
                    @php
                        $fileGambar = $item->foto ?? $item->gambar ?? 'default.png';
                        if(empty($fileGambar)) { $fileGambar = 'default.png'; }
                    @endphp
                    
                    <div class="bg-white p-4 rounded-2xl border border-rose-100 shadow-sm hover:shadow-md transition flex flex-col justify-between h-[400px]">
                        <div>
                            <div class="w-full h-48 bg-rose-50 rounded-xl overflow-hidden mb-3 flex items-center justify-center relative">
                                <img src="{{ asset('uploads/produk/' . $fileGambar) }}" 
                                     class="w-full h-full object-cover object-center absolute inset-0" 
                                     alt="Produk Glow Beauty"
                                     onerror="this.onerror=null; this.src='{{ asset('uploads/produk/default.png') }}';">
                                @if(isset($item->diskon) && $item->diskon > 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm z-10">
                                    {{ $item->diskon }}% OFF
                                    </span>
                                @endif
                            </div>

                            <div class="flex justify-between items-center">
                            <span class="text-[10px] font-bold text-rose-500 uppercase bg-rose-50 px-2 py-1 rounded-md tracking-wider">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                            
                                @if(isset($item->rating) && $item->rating > 0)
                                    <span class="text-xs text-amber-500 font-semibold flex items-center gap-1 bg-amber-50 px-2 py-0.5 rounded-md">
                                        <i class="fa-solid fa-star text-[10px]"></i> {{ $item->rating }}
                                    </span>
                                @endif
                        </div>
                            <h3 class="font-semibold text-gray-800 text-sm mt-2 line-clamp-2 min-h-[40px]">
                                {{ $item->nama ?? $item->nama_produk ?? 'Produk Kecantikan' }}
                            </h3>
                        </div>

                        <div class="mt-auto">
                                @if(isset($item->diskon) && $item->diskon > 0)
                                @php
                                    $hargaDiskon = ($item->harga ?? 0) - (($item->harga ?? 0) * ($item->diskon / 100));
                                @endphp
                                <p class="text-gray-400 line-through text-[11px] -mb-1">
                                    Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-rose-600 font-bold text-sm">
                                    Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                                </p>
                            @else
                                <p class="text-rose-600 font-bold text-sm">
                                    Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                                </p>
                            @endif
                            <form action="{{ route('keranjang.tambah', $item->id ?? $item->id_produk) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-rose-600 text-white px-4 py-2 rounded-lg w-full hover:bg-rose-700 transition">                            
                                    <i class="fa-solid fa-cart-shopping"></i> Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full bg-white p-12 rounded-2xl text-center border border-rose-100 shadow-sm">
                    <span class="text-4xl">🌸</span>
                    <p class="text-sm text-gray-500 mt-3">Belum ada produk kosmetik baru yang di-upload oleh admin.</p>
                </div>
            @endif
        </div>
    </div>

</body>
</html>