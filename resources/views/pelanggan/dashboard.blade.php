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
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">Halo, Pelanggan ✨</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white px-4 py-1.5 rounded-full text-xs font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="p-8 max-w-7xl mx-auto">
        <div class="bg-gradient-to-r from-rose-400 to-pink-500 p-8 rounded-3xl text-white mb-10 shadow-md">
            <h2 class="text-3xl font-bold mb-2">Belanja Produk Favoritmu ✨</h2>
            <p class="text-rose-100 text-sm">Dapatkan diskon eksklusif khusus member Glow Beauty hari ini.</p>
        </div>

        <h2 class="text-xl font-bold mb-6 text-rose-950">Katalog Produk Terpopuler</h2>

        <div class="mb-8">
            <form action="{{ url()->current() }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari produk kecantikan..." 
                       class="w-full md:w-1/3 px-4 py-2 rounded-xl border border-rose-100 focus:ring-2 focus:ring-rose-400 outline-none">
                <button type="submit" class="bg-rose-600 text-white px-6 py-2 rounded-xl hover:bg-rose-700 transition">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
                @if(request()->has('search'))
                    <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-100 rounded-xl hover:bg-gray-200 text-gray-600">Reset</a>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @if(isset($produk) && count($produk) > 0)
                @foreach($produk as $item)
                    @php
                        $fileGambar = $item->foto ?? $item->gambar ?? 'default.png';
                        if(empty($fileGambar)) { $fileGambar = 'default.png'; }
                    @endphp
                    
                    <div class="bg-white p-4 rounded-2xl border border-rose-100 shadow-sm hover:shadow-md transition flex flex-col justify-between h-[450px]">
                        <div>
                            <div class="w-full h-48 bg-rose-50 rounded-xl overflow-hidden mb-3 flex items-center justify-center relative">
                                <img src="{{ asset('uploads/produk/' . $fileGambar) }}" 
                                     class="w-full h-full object-cover object-center absolute inset-0" 
                                     alt="Produk Glow Beauty"
                                     onerror="this.onerror=null; this.src='{{ asset('uploads/produk/default.png') }}';">
                            </div>

                            <span class="text-[10px] font-bold text-rose-500 uppercase bg-rose-50 px-2 py-1 rounded-md tracking-wider">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                            
                            <h3 class="font-semibold text-gray-800 text-sm mt-2 line-clamp-1">
                                {{ $item->nama ?? $item->nama_produk ?? 'Produk Kecantikan' }}
                            </h3>

                            <p class="text-[11px] text-gray-500 mt-1 line-clamp-3 leading-tight min-h-[45px]">
                                {{ $item->deskripsi ?? $item->deskripsi_produk ?? 'Produk kecantikan berkualitas dari Glow Beauty.' }}
                            </p>
                        </div>

                        <div class="mt-auto pt-4">
                            <p class="text-rose-600 font-bold text-sm">
                                Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                            </p>
                            <form action="{{ route('keranjang.tambah') }}" method="POST">
    @csrf
<input type="hidden" name="id_produk" value="{{ $item->id_produk }}">   
<button type="submit" class="w-full mt-3 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium py-2.5 rounded-xl transition flex items-center justify-center gap-1">        
    <i class="fa-solid fa-cart-shopping"></i> Beli Sekarang
    </button>
</form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full bg-white p-12 rounded-2xl text-center border border-rose-100 shadow-sm">
                    <span class="text-4xl">🌸</span>
                    <p class="text-sm text-gray-500 mt-3">Produk tidak ditemukan atau belum ada produk.</p>
                </div>
            @endif
        </div>
    </div>
    

</body>
</html>