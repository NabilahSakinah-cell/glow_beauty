<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 0.8s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-rose-50/30 min-h-screen p-4 md:p-8">
    <div class="max-w-4xl mx-auto fade-in">
        <h2 class="text-2xl font-bold text-rose-950 mb-6">CHECKOUT</h2>
        <form action="{{ route('keranjang.checkout') }}" method="POST" id="checkoutForm" class="grid md:grid-cols-2 gap-8">
            @csrf
            
            <!-- KOLOM KIRI: DATA PEMESAN -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-rose-100">
                <h3 class="font-bold text-lg mb-4 text-rose-900">Data Pemesan</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full border rounded-lg p-2.5">
                    </div>
                    
                    <!-- ✨ TAMBAHAN DROPDOWN WILAYAH -->
                    <div>
                        <label class="block text-sm font-semibold mb-1">Wilayah / Kota Tujuan</label>
                        <select name="wilayah" required class="w-full border rounded-lg p-2.5 bg-white text-gray-700">
                            <option value="" disabled selected>-- Pilih Wilayah --</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Bali">Bali</option>
                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                            <option value="Luar Wilayah Lainnya">Luar Wilayah Lainnya</option>
                        </select>
                    </div>

                    <!-- ✨ DIUBAH JADI DETAIL ALAMAT -->
                    <div>
                        <label class="block text-sm font-semibold mb-1">Detail Alamat</label>
                        <textarea name="alamat_detail" required class="w-full border rounded-lg p-2.5" rows="2" placeholder="Nama Jalan, RT/RW, Patokan..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1">No. Telepon</label>
                        <input type="text" name="no_telepon" required class="w-full border rounded-lg p-2.5">
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: RINGKASAN PESANAN -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-rose-100 h-fit">
                <h3 class="font-bold text-lg mb-4 text-rose-900">Ringkasan Pesanan</h3>
                <div class="space-y-3 text-gray-700">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($keranjang->sum(fn($item) => $item->harga * $item->jumlah), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span>Ongkir</span>
                        <span>Rp 15.000</span>
                    </div>
                    <div class="flex justify-between border-t pt-2 text-xl font-bold text-rose-600">
                        <span>Total</span>
                        <span>Rp {{ number_format($keranjang->sum(fn($item) => $item->harga * $item->jumlah) + 15000, 0, ',', '.') }}</span>
                    </div>
                </div>
                <button type="submit" id="btnSubmit" class="w-full mt-6 bg-rose-500 hover:bg-rose-600 text-white py-3 rounded-lg font-bold transition-all transform hover:scale-[1.02] active:scale-95">
                    Pesan Sekarang
                </button>
            </div>
            
        </form>
    </div>
    
    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerText = 'Memproses...';
        });
    </script>
</body>
</html>