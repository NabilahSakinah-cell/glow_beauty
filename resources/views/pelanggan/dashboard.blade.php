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
        .modal-masuk { animation: muncul 0.3s ease-out forwards; }
        @keyframes muncul {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
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
                <a href="{{ route('keranjang.index') }}" class="text-rose-600 hover:text-rose-800 transition-all duration-300 p-2">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="p-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-8">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-2xl text-emerald-500"></i>
                        <span class="font-medium text-sm md:text-base">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-gradient-to-r from-rose-400 to-pink-500 p-8 rounded-3xl text-white mb-10 shadow-md">
            <h2 class="text-3xl font-bold mb-2">Belanja Produk Favoritmu ✨</h2>
            <p class="text-rose-100 text-sm">Dapatkan diskon eksklusif khusus member Glow Beauty hari ini.</p>
            <div class="mt-6">
                <button onclick="document.getElementById('modal-lacak').classList.remove('hidden')" 
                        class="bg-white text-rose-600 px-6 py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-rose-50 transition">
                    <i class="fa-solid fa-truck-fast"></i> Lacak Pesanan Saya
                </button>
            </div>
        </div>

            @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-xl mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

        <h2 class="text-xl font-bold mb-6 text-rose-950">Katalog Produk Terpopuler</h2>
        <form action="{{ route('pelanggan.dashboard') }}" method="GET" class="flex gap-2 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="border border-rose-200 rounded-xl px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-rose-300">
            <button type="submit" class="bg-rose-600 text-white px-6 py-2 rounded-xl hover:bg-rose-700 transition">Cari</button>
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
                                <img src="{{ asset('uploads/produk/' . $fileGambar) }}" class="w-full h-full object-cover object-center absolute inset-0" alt="Produk" onerror="this.onerror=null; this.src='{{ asset('uploads/produk/default.png') }}';">
                                @if(isset($item->diskon) && $item->diskon > 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-md shadow-sm z-10">{{ $item->diskon }}% OFF</span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] font-bold text-rose-500 uppercase bg-rose-50 px-2 py-1 rounded-md tracking-wider">{{ $item->kategori ?? 'Umum' }}</span>
                                @if(isset($item->rating) && $item->rating > 0)
                                    <span class="text-xs text-amber-500 font-semibold flex items-center gap-1 bg-amber-50 px-2 py-0.5 rounded-md"><i class="fa-solid fa-star text-[10px]"></i> {{ $item->rating }}</span>
                                @endif
                            </div>
                            <a href="{{ route('produk.detail', $item->id ?? $item->id_produk) }}">
                                <h3 class="font-semibold text-gray-800 text-sm mt-2 line-clamp-2 min-h-[40px] hover:text-rose-600 transition">{{ $item->nama ?? $item->nama_produk ?? 'Produk' }}</h3>
                            </a>
                        </div>
                        <div class="mt-auto">
                            @if(isset($item->diskon) && $item->diskon > 0)
                                @php $hargaDiskon = ($item->harga ?? 0) - (($item->harga ?? 0) * ($item->diskon / 100)); @endphp
                                <p class="text-gray-400 line-through text-[11px] -mb-1">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</p>
                                <p class="text-rose-600 font-bold text-sm">Rp {{ number_format($hargaDiskon, 0, ',', '.') }}</p>
                            @else
                                <p class="text-rose-600 font-bold text-sm">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</p>
                            @endif
                            <form action="{{ route('keranjang.tambah', $item->id ?? $item->id_produk) }}" method="POST">
                                @csrf
                                <button type="submit" class="mt-2 bg-rose-600 text-white px-4 py-2 rounded-lg w-full hover:bg-rose-700 transition">
                                    <i class="fa-solid fa-cart-shopping"></i> Beli Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full bg-white p-12 rounded-2xl text-center border border-rose-100 shadow-sm">
                    <span class="text-4xl">🌸</span>
                    <p class="text-sm text-gray-500 mt-3">Belum ada produk.</p>
                </div>
            @endif
        </div>
    </div>

    <div id="modal-lacak" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl relative modal-masuk max-h-[90vh] overflow-y-auto">
        <button onclick="document.getElementById('modal-lacak').classList.add('hidden')" class="absolute top-4 right-5 text-gray-400 hover:text-rose-500 text-xl transition"><i class="fa-solid fa-xmark"></i></button>
        
        <h3 class="text-xl font-black text-gray-800 mb-6 border-b border-gray-100 pb-4 flex items-center gap-2">
            <i class="fa-solid fa-map-location-dot text-rose-500"></i> Status Pengiriman
        </h3>

            <div class="relative border-l-2 border-gray-200 ml-4 space-y-8 mt-4 mb-8">
                <div class="relative pl-6">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full {{ $status == 'selesai' ? 'bg-rose-500' : 'bg-gray-200' }} border-2 border-white"></div>
                    <p class="text-sm font-bold {{ $status == 'selesai' ? 'text-rose-600' : 'text-gray-400' }}">Paket Tiba di Tujuan</p>
                </div>

                <div class="relative pl-6">
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full {{ $status == 'dikirim' ? 'bg-rose-500' : 'bg-gray-200' }} border-2 border-white"></div>
                    <p class="text-sm font-bold {{ $status == 'dikirim' ? 'text-rose-600' : 'text-gray-400' }}">Sedang Dikirim</p>
                </div>

                <div class="relative pl-6">
                    <div class="absolute -left-[11px] -top-1 w-5 h-5 rounded-full {{ in_array($status, ['pending', 'diproses']) ? 'bg-rose-500' : 'bg-gray-200' }} border-4 border-white shadow-sm"></div>
                    <p class="text-sm font-bold {{ in_array($status, ['pending', 'diproses']) ? 'text-rose-600' : 'text-gray-400' }}">Pesanan Diproses</p>
                </div>
            </div>
            
                @if($status == 'selesai')
            <div class="mb-6 p-6 bg-green-50 border-2 border-green-100 rounded-2xl text-center">
                <h3 class="text-lg font-bold text-gray-800">Pesananmu telah diterima! 🥳</h3>
                <p class="text-sm text-gray-600 mb-4">Terima kasih telah berbelanja. Yuk, beri rating!</p>
                
                <!-- MENGARAHKAN KE RUTE YANG SUDAH ADA -->
               @if(isset($order) && $order)
    <a href="{{ route('review.create', $order->id_pesanan) }}" 
       class="block w-full bg-pink-500 text-white py-3 rounded-xl font-bold shadow-lg hover:bg-pink-600 transition text-center">
        Beri Penilaian
    </a>
@else
    <div class="p-3 bg-gray-100 text-gray-500 rounded-xl text-center text-sm">
        Belum ada pesanan yang bisa dinilai
    </div>
@endif
@endif

            <button onclick="document.getElementById('modal-lacak').classList.add('hidden')" class="w-full bg-gray-100 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-200 transition">Tutup</button>
        </div>
    </div>
</body>
</html>