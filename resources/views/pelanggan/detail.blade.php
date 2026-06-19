<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk ?? $produk->nama ?? 'Detail Produk' }} - Glow Beauty</title>
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
                <a href="{{ route('keranjang.index') }}"
                   class="text-rose-600 hover:text-rose-800 transition-all duration-300 p-2">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="p-8 max-w-5xl mx-auto">

        <a href="{{ route('pelanggan.dashboard') }}" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium mb-6 w-fit">
            &larr; Kembali ke Katalog
        </a>

        @php
            $fileGambar = $produk->foto ?? $produk->gambar ?? 'default.png';
            if (empty($fileGambar)) { $fileGambar = 'default.png'; }

            $adaDiskon = isset($produk->diskon) && $produk->diskon > 0;
            $hargaDiskon = $adaDiskon
                ? ($produk->harga ?? 0) - (($produk->harga ?? 0) * ($produk->diskon / 100))
                : ($produk->harga ?? 0);
        @endphp

        <div class="bg-white rounded-3xl border border-rose-100 shadow-sm overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-0">

            <div class="w-full h-72 md:h-full bg-rose-50 relative">
                <img src="{{ asset('uploads/produk/' . $fileGambar) }}"
                     class="w-full h-full object-cover object-center absolute inset-0"
                     alt="{{ $produk->nama_produk ?? $produk->nama ?? 'Produk Glow Beauty' }}"
                     onerror="this.onerror=null; this.src='{{ asset('uploads/produk/default.png') }}';">
                @if($adaDiskon)
                    <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-md shadow-sm z-10">
                        {{ $produk->diskon }}% OFF
                    </span>
                @endif
            </div>

            <div class="p-8 flex flex-col">
                <span class="text-[11px] font-bold text-rose-500 uppercase bg-rose-50 px-2 py-1 rounded-md tracking-wider w-fit mb-3">
                    {{ $produk->kategori ?? 'Umum' }}
                </span>

                <h2 class="text-2xl font-bold text-rose-950 mb-2">
                    {{ $produk->nama_produk ?? $produk->nama ?? 'Produk Kecantikan' }}
                </h2>

                @if(isset($produk->rating) && $produk->rating > 0)
                    <span class="text-sm text-amber-500 font-semibold flex items-center gap-1 w-fit mb-4">
                        <i class="fa-solid fa-star text-xs"></i> {{ $produk->rating }}
                    </span>
                @endif

                <div class="mb-4">
                    @if($adaDiskon)
                        <p class="text-gray-400 line-through text-sm -mb-1">
                            Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}
                        </p>
                        <p class="text-rose-600 font-bold text-2xl">
                            Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
                        </p>
                    @else
                        <p class="text-rose-600 font-bold text-2xl">
                            Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}
                        </p>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-rose-900 mb-1">Deskripsi Produk</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $produk->deskripsi_produk ?? $produk->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}
                    </p>
                </div>

                <form action="{{ route('keranjang.tambah', $produk->id_produk ?? $produk->id) }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="bg-rose-600 text-white px-4 py-3 rounded-lg w-full hover:bg-rose-700 transition font-semibold">
                        <i class="fa-solid fa-cart-shopping"></i> Tambah Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>