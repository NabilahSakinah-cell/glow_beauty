<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-8 min-h-screen">
    
    <div class="max-w-3xl mx-auto animate-fade-in">
        <div class="mb-8">
            <a href="/admin/dashboard" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium transform hover:-translate-x-1 duration-200">
                &larr; Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold mt-4 text-rose-950">Tambah Produk Baru 🛍️</h1>
            <p class="text-slate-500 mt-1">Masukkan rincian produk kosmetik baru ke dalam sistem.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-rose-100/50 border border-rose-100">
            
            <form action="/admin/produk/simpan" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: Serum Anti Aging Gold">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-slate-700 font-medium mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: 150000">
                    </div>
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Diskon (%)</label>
                    <input type="number" name="diskon" required value="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200">
                </div>
                    <div>
                        <label class="block text-slate-700 font-medium mb-2">Stok Awal <span class="text-red-500">*</span></label>
                        <input type="number" name="stok" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: 50">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200 cursor-pointer">
                        <option value="">-- Pilih Kategori Produk --</option>
                        <option value="Skincare">Skincare (Perawatan Kulit)</option>
                        <option value="Makeup">Makeup (Kosmetik)</option>
                        <option value="Bodycare">Bodycare (Perawatan Tubuh)</option>
                        <option value="Haircare">Haircare (Perawatan Rambut)</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Deskripsi Produk <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi_produk" rows="4" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Tuliskan manfaat, kandungan, dan cara pemakaian produk..."></textarea>
                </div>

                <div class="mb-8">
                    <label class="block text-slate-700 font-medium mb-2">Foto Produk <span class="text-red-500">*</span></label>
                    <input type="file" name="gambar" accept="image/*" required class="w-full text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition duration-200 cursor-pointer">
                    <p class="text-xs text-slate-400 mt-2">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB.</p>
                </div>

                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3.5 px-6 rounded-xl transition duration-300 transform active:scale-95 shadow-md shadow-rose-200">
                    💾 Simpan Data Produk
                </button>
                
            </form>
        </div>
    </div>

</body>
</html>