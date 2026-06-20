<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow Beauty - Healthy Skin, Happy Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .modal-masuk { animation: muncul 0.3s ease-out forwards; }
        @keyframes muncul {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body class="bg-[#FFF5F7] text-gray-800">

    <!-- 1. NAVBAR -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-rose-500">
                Glow <span class="text-rose-400">Beauty</span>
            </a>
            
            <div class="hidden md:flex gap-8 text-sm font-semibold text-gray-600">
                <a href="{{ route('home') }}" class="text-rose-500">Home</a>
                <a href="#tentang" class="hover:text-rose-500 transition">Tentang Kami</a>
                <a href="#kontak" class="hover:text-rose-500 transition">Kontak</a>
            </div>

            <!-- DROPDOWN LOGIN -->
            <div class="flex items-center">
                <div class="relative group">
                    <button class="flex items-center gap-2 bg-rose-100 text-rose-600 px-5 py-2 rounded-full font-bold hover:bg-rose-500 hover:text-white transition shadow-sm text-sm">
                        <i class="fa-regular fa-user"></i> Masuk
                    </button>
                    
                    <div class="absolute right-0 top-full pt-2 w-44 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="bg-white rounded-xl shadow-xl border border-rose-100 overflow-hidden flex flex-col">
                            <a href="{{ route('login') }}" class="px-4 py-3 text-sm text-gray-700 hover:bg-rose-50 hover:text-rose-600 border-b border-gray-50 flex items-center gap-3 transition">
                                <i class="fa-solid fa-bag-shopping text-rose-400 w-4 text-center"></i> Pelanggan
                            </a>
                            <a href="{{ url('/login-admin') }}" class="px-4 py-3 text-sm text-gray-700 hover:bg-rose-50 hover:text-rose-600 border-b border-gray-50 flex items-center gap-3 transition">
                                <i class="fa-solid fa-laptop-code text-rose-400 w-4 text-center"></i> Admin
                            </a>
                            <a href="{{ url('/login-owner') }}" class="px-4 py-3 text-sm text-gray-700 hover:bg-rose-50 hover:text-rose-600 flex items-center gap-3 transition">
                                <i class="fa-solid fa-crown text-rose-400 w-4 text-center"></i> Owner
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="max-w-7xl mx-auto mt-6 px-4 md:px-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-xl"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- 2. HERO SECTION -->
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-10 md:py-20 flex flex-col md:flex-row items-center gap-10">
        <div class="w-full md:w-1/2 space-y-6">
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-gray-900 leading-tight">
                Glow <span class="text-rose-500">Beauty</span>
            </h1>
            <h2 class="text-2xl font-serif text-rose-400 italic">Healthy Skin, Happy Life</h2>
            <p class="text-gray-600 max-w-md text-sm md:text-base leading-relaxed">
                Temukan skincare & makeup terbaik untuk tampil percaya diri setiap hari.
            </p>
            <div class="flex gap-4 pt-4">
                <!-- Jika sudah login ke katalog, jika belum ke halaman login -->
                <a href="{{ auth()->check() ? route('katalog') : route('login') }}" class="bg-rose-500 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-rose-200 hover:bg-rose-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-bag-shopping"></i> Belanja Sekarang
                </a>
                <a href="{{ auth()->check() ? route('katalog') : route('login') }}" class="bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-xl font-semibold hover:border-rose-300 hover:text-rose-500 transition">
                    Lihat Produk
                </a>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 relative flex justify-center">
            <div class="absolute inset-0 bg-rose-200 blur-[80px] rounded-full opacity-50"></div>
            <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=800&auto=format&fit=crop" alt="Skincare" class="relative z-10 w-4/5 h-auto object-cover rounded-3xl shadow-xl border-4 border-white">
        </div>
    </div>

    <!-- 3. PRODUK TERLARIS -->
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-16 bg-white rounded-t-[3rem] shadow-sm border-t border-rose-50">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Produk Terlaris</h2>
            <a href="{{ auth()->check() ? route('katalog') : route('login') }}" class="text-sm text-rose-500 font-semibold hover:underline">Lihat Semua ></a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($produk as $item)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-rose-100 flex flex-col h-full p-4 group">
                
                <a href="{{ auth()->check() ? route('produk.detail', $item->id ?? $item->id_produk) : route('login') }}" class="relative aspect-square block overflow-hidden rounded-xl mb-4 bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset('uploads/produk/' . ($item->gambar ?? 'default.png')) }}" alt="{{ $item->nama_produk ?? $item->nama }}" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                </a>

                <div class="flex flex-col flex-grow">
                    <div class="flex justify-between items-center mb-3">
                        <span class="bg-rose-50 text-rose-500 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wide">
                            {{ $item->kategori ?? 'SKINCARE' }}
                        </span>
                        <div class="flex items-center gap-1 text-yellow-400 text-xs font-bold">
                            <i class="fa-solid fa-star"></i> 5.0
                        </div>
                    </div>
                    
                    <a href="{{ auth()->check() ? route('produk.detail', $item->id ?? $item->id_produk) : route('login') }}" class="flex-grow">
                        <h3 class="text-gray-800 font-bold text-sm md:text-base line-clamp-2 leading-snug mb-3">
                            {{ $item->nama_produk ?? $item->nama }}
                        </h3>
                    </a>
                    
                    <div class="mt-auto mb-4">
                        <p class="text-[11px] text-gray-400 line-through mb-0.5">Rp {{ number_format(($item->harga ?? 0) + 15000, 0, ',', '.') }}</p>
                        <p class="text-lg font-bold text-rose-600">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</p>
                    </div>
                    
                    <!-- LOGIKA TOMBOL BELI -->
                    @auth
                        <!-- Jika SUDAH Login: Eksekusi aksi keranjang -->
                        <form action="{{ route('keranjang.tambah', $item->id ?? $item->id_produk) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-[#E11D48] text-white py-2 rounded-xl font-bold hover:bg-rose-700 transition flex justify-center items-center gap-2 shadow-sm text-sm">
                                <i class="fa-solid fa-cart-plus"></i> Beli Sekarang
                            </button>
                        </form>
                    @else
                        <!-- Jika BELUM Login: Arahkan ke Halaman Login -->
                        <a href="{{ route('login') }}" class="w-full bg-[#E11D48] text-white py-2 rounded-xl font-bold hover:bg-rose-700 transition flex justify-center items-center gap-2 shadow-sm text-sm text-center">
                            <i class="fa-solid fa-cart-plus"></i> Beli Sekarang
                        </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-10 text-gray-500">Belum ada produk untuk ditampilkan.</div>
            @endforelse
        </div>
    </div>

    <!-- 4. PROMO BANNER -->
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-10 bg-white">
        <div class="bg-gradient-to-r from-rose-100 to-pink-50 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between border border-rose-200 shadow-sm relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-rose-200 rounded-full blur-3xl opacity-50"></div>
            <div class="relative z-10 text-center md:text-left mb-6 md:mb-0">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Promo Spesial Bulan Ini</h2>
                <p class="text-gray-600 mb-6 max-w-sm">Diskon hingga <span class="font-bold text-rose-500">30%</span> untuk produk pilihan Glow Beauty.</p>
                <a href="{{ auth()->check() ? route('katalog') : route('login') }}" class="bg-rose-500 text-white px-8 py-3 rounded-full font-bold shadow-md hover:bg-rose-600 transition inline-block">
                    Belanja Sekarang
                </a>
            </div>
            <div class="relative z-10 bg-white/60 backdrop-blur-sm w-32 h-32 rounded-full flex flex-col items-center justify-center border-4 border-white shadow-lg transform rotate-12">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Diskon</span>
                <span class="text-4xl font-black text-rose-500">30%</span>
            </div>
        </div>
    </div>

    <!-- 5. TENTANG KAMI -->
    <div id="tentang" class="bg-white py-16 border-t border-rose-50">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-serif font-bold text-rose-500 mb-6">Cerita Glow Beauty ✨</h2>
            <p class="text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Berawal dari mimpi untuk menemani *glow-up journey* setiap orang, <strong>Glow Beauty</strong> hadir sebagai sahabat terbaik kulitmu. 
                Kami percaya bahwa kecantikan sejati berasal dari kulit yang sehat dan rasa percaya diri. Semua produk yang kami sediakan 
                telah melewati kurasi ketat, 100% original, dan pastinya aman untuk membantumu memancarkan pesona terbaik setiap hari!
            </p>
        </div>
    </div>

    <!-- 6. FOOTER & KONTAK -->
    <footer id="kontak" class="bg-[#FFF5F7] border-t border-rose-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 md:px-8 grid grid-cols-1 md:grid-cols-4 gap-10 mb-12 text-sm text-gray-600">
            
            <div>
                <h3 class="text-2xl font-serif font-bold text-rose-500 mb-4">Glow <span class="text-rose-400">Beauty</span></h3>
                <p class="leading-relaxed mb-4">
                    Toko skincare dan makeup terpercaya untuk kulit sehat dan kecantikanmu.
                </p>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4 text-base">Menu</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="hover:text-rose-500 transition">Home</a></li>
                    <li><a href="{{ auth()->check() ? route('katalog') : route('login') }}" class="hover:text-rose-500 transition">Katalog</a></li>
                    <li><a href="#tentang" class="hover:text-rose-500 transition">Tentang Kami</a></li>
                    <li><a href="#kontak" class="hover:text-rose-500 transition">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4 text-base">Informasi</h4>
                <ul class="space-y-3">
                    <li><a href="javascript:void(0)" onclick="bukaModal('modal-cara-belanja')" class="hover:text-rose-500 transition cursor-pointer">Cara Belanja</a></li>
                    <li><a href="javascript:void(0)" onclick="bukaModal('modal-privasi')" class="hover:text-rose-500 transition cursor-pointer">Kebijakan Privasi</a></li>
                    <li><a href="javascript:void(0)" onclick="bukaModal('modal-syarat')" class="hover:text-rose-500 transition cursor-pointer">Syarat & Ketentuan</a></li>
                    <li><a href="javascript:void(0)" onclick="bukaModal('modal-pengembalian')" class="hover:text-rose-500 transition cursor-pointer">Pengembalian</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-4 text-base">Kontak Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-phone text-rose-400 mt-1"></i>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-regular fa-envelope text-rose-400 mt-1"></i>
                        <span>hello@glowbeauty.com</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot text-rose-400 mt-1"></i>
                        <span>Jl. Beauty No. 10<br>Parepare, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-8 pt-8 border-t border-rose-200 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>&copy; 2026 Glow Beauty. All rights reserved.</p>
            <div class="flex gap-4 text-base">
                <a href="#" class="hover:text-rose-500 transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="hover:text-rose-500 transition"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </footer>

    <!-- KUMPULAN MODAL POP-UP INFORMASI -->
    <!-- Modal 1: Cara Belanja -->
    <div id="modal-cara-belanja" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl w-full max-w-lg p-6 md:p-8 modal-masuk shadow-2xl relative">
            <button onclick="tutupModal('modal-cara-belanja')" class="absolute top-4 right-4 text-gray-400 hover:text-rose-500 text-xl"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-xl font-bold text-rose-600 mb-4 border-b border-rose-100 pb-3"><i class="fa-solid fa-bag-shopping mr-2"></i>Cara Belanja</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><span class="font-bold text-rose-500">1.</span> Pilih produk kosmetik impianmu di halaman <strong>Katalog</strong>.</li>
                <li><span class="font-bold text-rose-500">2.</span> Klik tombol <strong>Beli Sekarang</strong> untuk memasukkannya ke keranjang.</li>
                <li><span class="font-bold text-rose-500">3.</span> Buka Keranjang, pastikan pesanan sudah benar, lalu klik <strong>Checkout</strong>.</li>
                <li><span class="font-bold text-rose-500">4.</span> Tim Glow Beauty akan segera memproses pesanan agar cepat sampai ke tanganmu!</li>
            </ul>
        </div>
    </div>

    <!-- Modal 2: Kebijakan Privasi -->
    <div id="modal-privasi" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl w-full max-w-lg p-6 md:p-8 modal-masuk shadow-2xl relative">
            <button onclick="tutupModal('modal-privasi')" class="absolute top-4 right-4 text-gray-400 hover:text-rose-500 text-xl"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-xl font-bold text-rose-600 mb-4 border-b border-rose-100 pb-3"><i class="fa-solid fa-shield-halved mr-2"></i>Kebijakan Privasi</h3>
            <p class="text-sm text-gray-600 leading-relaxed mb-3">
                Keamanan data kamu adalah prioritas kami! Data pribadi seperti nama, email, dan riwayat pesanan hanya digunakan untuk keperluan transaksi dan pengiriman pesanan di <strong>Glow Beauty</strong>.
            </p>
            <p class="text-sm text-gray-600 leading-relaxed">
                Kami berkomitmen 100% untuk tidak menyebarkan atau memperjualbelikan data pelanggan kepada pihak ketiga mana pun.
            </p>
        </div>
    </div>

    <!-- Modal 3: Syarat & Ketentuan -->
    <div id="modal-syarat" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl w-full max-w-lg p-6 md:p-8 modal-masuk shadow-2xl relative">
            <button onclick="tutupModal('modal-syarat')" class="absolute top-4 right-4 text-gray-400 hover:text-rose-500 text-xl"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-xl font-bold text-rose-600 mb-4 border-b border-rose-100 pb-3"><i class="fa-solid fa-file-contract mr-2"></i>Syarat & Ketentuan</h3>
            <ul class="space-y-2 text-sm text-gray-600 list-disc pl-4">
                <li>Harga produk yang tertera dapat berubah sewaktu-waktu sesuai kebijakan toko.</li>
                <li>Promo diskon hanya berlaku selama periode yang telah ditentukan dan selama stok masih ada.</li>
                <li>Pihak Glow Beauty berhak membatalkan pesanan jika terdeteksi adanya kecurangan dalam transaksi.</li>
            </ul>
        </div>
    </div>

    <!-- Modal 4: Pengembalian -->
    <div id="modal-pengembalian" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl w-full max-w-lg p-6 md:p-8 modal-masuk shadow-2xl relative">
            <button onclick="tutupModal('modal-pengembalian')" class="absolute top-4 right-4 text-gray-400 hover:text-rose-500 text-xl"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="text-xl font-bold text-rose-600 mb-4 border-b border-rose-100 pb-3"><i class="fa-solid fa-box-open mr-2"></i>Kebijakan Pengembalian</h3>
            <p class="text-sm text-gray-600 leading-relaxed mb-3">
                Barang yang diterima rusak, bocor, atau tidak sesuai pesanan? Jangan panik!
            </p>
            <ul class="space-y-2 text-sm text-gray-600 list-disc pl-4">
                <li>Klaim pengembalian wajib menyertakan <strong>Video Unboxing</strong> utuh tanpa jeda dari awal buka paket.</li>
                <li>Batas waktu laporan maksimal 2x24 jam sejak paket berstatus "Diterima".</li>
                <li>Silakan hubungi WhatsApp Admin untuk proses retur barang dengan cepat.</li>
            </ul>
        </div>
    </div>

    <script>
        function bukaModal(idModal) {
            document.getElementById(idModal).classList.remove('hidden');
        }
        function tutupModal(idModal) {
            document.getElementById(idModal).classList.add('hidden');
        }
    </script>

</body>
</html>