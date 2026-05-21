<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-rose-50 font-[Poppins]">
    
    <nav class="bg-white/70 backdrop-blur-md sticky top-0 px-8 py-4 flex justify-between items-center z-50 border-b border-rose-100">
        <span class="text-2xl font-bold text-rose-600" style="font-family: 'Playfair Display'">Glow Beauty</span>
        
        <div class="relative w-72 md:w-96">
            <input type="text" id="inputCari" placeholder="Cari skincare..." class="w-full bg-rose-50 border border-rose-100 rounded-full px-5 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-rose-300 transition text-sm text-gray-700">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-3 text-rose-400 text-xs"></i>
        </div>

        <div class="flex items-center gap-6">
            <button id="btnWishlist" class="relative text-rose-400 hover:scale-110 transition">
                <i class="fa-solid fa-heart text-xl"></i>
                <span id="badgeWishlist" class="absolute -top-2 -right-2 bg-rose-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full hidden">0</span>
            </button>

            <button id="btnKeranjang" class="relative text-rose-600 hover:scale-110 transition">
                <i class="fa-solid fa-cart-shopping text-xl"></i>
                <span id="badgeKeranjang" class="absolute -top-2 -right-2 bg-rose-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
            </button>

            <form method="POST" action="{{ route('logout') }}" class="text-right"> 
                @csrf
                <p class="text-[10px] text-gray-400 leading-none">Selamat datang,</p>
                <button type="submit" class="text-rose-600 font-bold text-sm hover:text-rose-800 transition">Logout</button> 
            </form>
        </div>
    </nav> <div class="p-8 max-w-7xl mx-auto">
        <div class="bg-rose-200 h-48 rounded-[2rem] mb-10 flex items-center px-12 relative overflow-hidden shadow-inner">
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-rose-900">Belanja Produk Favoritmu ✨</h2>
                <p class="text-rose-700 mt-2">Dapatkan diskon eksklusif</p>
            </div>
            <div class="absolute -right-10 top-0 w-64 h-64 bg-white/20 rounded-full blur-3xl"></div>
        </div>

        <h3 class="text-xl font-bold text-rose-900 mb-6">Katalog Produk Terpopuler</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://images.soco.id/42950d77-2c46-4f18-841e-cd787b1c101c-image-0-1721878245913" alt="Serum" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Serum</p>
                <h4 class="font-bold text-gray-800">Glad To Glow Serum</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 50.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://medias.watsons.co.id/publishing/WTCID-52231-front-zoom.jpg?version=1750260571" alt="Sunscreen" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Sunscreen</p>
                <h4 class="font-bold text-gray-800">Sunscreen Skintific</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 80.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://media.suara.com/pictures/original/2025/05/21/30955-d-panthenol-gentle-low-ph-cleanser.jpg" alt="Face Wash" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Face Wash</p>
                <h4 class="font-bold text-gray-800">Scora Gentle Cleanser</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 60.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://image.idntimes.com/post/20251024/capture_acb2ee30-7ab1-41a2-b67e-f6d59002c7cc.PNG" alt="Moisturizer" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600 btn-add-cart"><i class="fa-solid fa-plus"></i></button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Moisturizer</p>
                <h4 class="font-bold text-gray-800">Glowsophy Moisturizer</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 45.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://assets.rakcer.id/main/2023/07/viva-waterdrop-sleeping-mask.jpg" alt="Masker" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600 btn-add-cart"><i class="fa-solid fa-plus"></i></button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Masker</p>
                <h4 class="font-bold text-gray-800">Viva Sleeping Mask</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 30.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <span class="absolute top-2 left-2 bg-rose-600 text-white text-[10px] font-bold px-2 py-1 rounded-lg z-10">-20%</span>
                    <img src="https://dimg.dillards.com/is/image/DillardsZoom/zoom/dior-dior-addict-lip-maximizer-plumping-gloss/00000000_zi_b7e5b609-f91f-44dd-a7f8-a48792ddf681.jpg" alt="Dior" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600 btn-add-cart"><i class="fa-solid fa-plus"></i></button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Lip Care</p>
                <h4 class="font-bold text-gray-800">Dior Lip Maximizer</h4>
                <div class="flex items-center gap-2 mt-2">
                    <p class="text-rose-600 font-bold italic">Rp 520.000</p>
                    <p class="text-gray-400 line-through text-xs italic">Rp 650.000</p>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://loverys.com.au/cdn/shop/files/SkintificCoverAllPerfectCushionSPF35PA_11g.png?v=1715672892&width=1946" alt="Cushion" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600 btn-add-cart"><i class="fa-solid fa-plus"></i></button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Makeup</p>
                <h4 class="font-bold text-gray-800">Skintific Cover All Perfect Cushion</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 150.000</p>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-rose-100 group transition hover:scale-105 hover:shadow-md cursor-pointer">
                <div class="aspect-square bg-rose-50 rounded-xl mb-4 overflow-hidden relative">
                    <img src="https://down-id.img.susercontent.com/file/id-11134207-8224q-mg63qa1t2sy133" alt="Blush On" class="w-full h-full object-cover">
                    <button class="absolute top-2 right-2 text-rose-300 hover:text-rose-500 transition btn-wish"><i class="fa-solid fa-heart"></i></button>
                    <button class="absolute bottom-2 right-2 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition text-rose-600 btn-add-cart"><i class="fa-solid fa-plus"></i></button>
                </div>
                <p class="text-xs text-rose-400 font-bold uppercase tracking-widest">Makeup</p>
                <h4 class="font-bold text-gray-800">Sea Makeup Blendable Blush</h4>
                <p class="text-rose-600 font-bold mt-2 italic">Rp 60.000</p>
            </div>
        </div>
    </div>

    <script>
        let jumlahKeranjang = 0;
        let jumlahWishlist = 0;

        const badgeKeranjang = document.getElementById('badgeKeranjang');
        const badgeWishlist = document.getElementById('badgeWishlist');

        document.querySelectorAll('.fa-plus').forEach(icon => {
            icon.parentElement.addEventListener('click', function(e) {
                e.preventDefault();
                jumlahKeranjang++;
                badgeKeranjang.textContent = jumlahKeranjang;
                badgeKeranjang.classList.add('scale-125');
                setTimeout(() => badgeKeranjang.classList.remove('scale-125'), 200);
                alert("Produk berhasil masuk keranjang! 🛒");
            });
        });

        document.querySelectorAll('.btn-wish').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const isFavorite = this.classList.contains('text-rose-500');
                if (!isFavorite) {
                    this.classList.remove('text-rose-300');
                    this.classList.add('text-rose-500');
                    jumlahWishlist++;
                } else {
                    this.classList.remove('text-rose-500');
                    this.classList.add('text-rose-300');
                    jumlahWishlist--;
                }
                badgeWishlist.textContent = jumlahWishlist;
                if (jumlahWishlist > 0) {
                    badgeWishlist.classList.remove('hidden');
                } else {
                    badgeWishlist.classList.add('hidden');
                }
                badgeWishlist.classList.add('scale-125');
                setTimeout(() => badgeWishlist.classList.remove('scale-125'), 200);
            });
        });

        const inputCari = document.getElementById('inputCari');
        const daftarProduk = document.querySelectorAll('.grid > div');

        inputCari.addEventListener('input', function() {
            const keyword = inputCari.value.toLowerCase();
            daftarProduk.forEach(card => {
                const namaProduk = card.querySelector('h4').textContent.toLowerCase();
                card.style.display = namaProduk.includes(keyword) ? "block" : "none";
            });
        });
    </script>
</body>
</html>