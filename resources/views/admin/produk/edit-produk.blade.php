<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin Glow Beauty</title>
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
    
@if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-8">
            <a href="/admin/produk/daftar" class="text-rose-600 hover:text-rose-700 transition ...">
                &larr; Kembali ke Daftar Produk
            </a>
            <h2 class="text-3xl font-bold text-rose-950">✏️ Edit Data Produk</h2>

    <div class="max-w-3xl mx-auto animate-fade-in">
        
        <div class="mb-8">
            <a href="/admin/produk/daftar" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium transform hover:-translate-x-1 duration-200 mb-2">
                &larr; Kembali ke Daftar Produk
            </a>
            <h2 class="text-3xl font-bold text-rose-950">✏️ Edit Data Produk</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi, harga, stok, atau gambar produk kosmetik Anda.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-rose-100/50 border border-rose-100">
            <form action="/admin/produk/update/{{ $produk->id ?? $produk->id_produk }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ $produk->nama_produk ?? $produk->nama }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: Serum Anti Aging Gold">
                </div>

                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Kategori</label>
                    <select name="kategori" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200 cursor-pointer">
                        <option value="Skincare" {{ ($produk->kategori ?? '') == 'Skincare' ? 'selected' : '' }}>Skincare (Perawatan Kulit)</option>
                        <option value="Makeup" {{ ($produk->kategori ?? '') == 'Makeup' ? 'selected' : '' }}>Makeup (Kosmetik)</option>
                        <option value="Bodycare" {{ ($produk->kategori ?? '') == 'Bodycare' ? 'selected' : '' }}>Bodycare (Perawatan Tubuh)</option>
                        <option value="Haircare" {{ ($produk->kategori ?? '') == 'Haircare' ? 'selected' : '' }}>Haircare (Perawatan Rambut)</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-slate-700 font-medium mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ $produk->harga ?? 0 }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: 150000">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-medium mb-2">Stok</label>
                        <input type="number" name="stok" value="{{ $produk->stok ?? 0 }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Contoh: 50">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-slate-700 font-medium mb-2">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" rows="4" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:bg-white focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition duration-200" placeholder="Tuliskan deskripsi lengkap produk di sini...">{{ $produk->deskripsi_produk ?? $produk->deskripsi ?? '' }}</textarea>
                </div>

                <div class="mb-8 border-t border-rose-50 pt-6">
                    <label class="block text-slate-700 font-medium mb-3">Gambar Produk</label>
                    <div class="flex items-start gap-4 flex-col sm:flex-row">
                        <div class="text-center">
                            <p class="text-xs text-slate-400 mb-2 font-medium">Gambar Saat Ini:</p>
                            <img src="{{ asset('uploads/produk/' . ($produk->gambar ?? $produk->foto ?? 'default.png')) }}" alt="Gambar Lama" class="w-24 h-24 object-cover rounded-2xl border border-rose-100 shadow-sm">
                        </div>
                        <div class="flex-1 w-full">
                            <p class="text-xs text-slate-400 mb-2 font-medium">Unggah Gambar Baru (Biarkan kosong jika tidak ingin diganti):</p>
                            <input type="file" name="gambar" accept="image/*" class="w-full text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 transition duration-200 cursor-pointer">
                            <p class="text-[11px] text-slate-400 mt-2">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center gap-4 border-t border-rose-50 pt-6">
                    <a href="/admin/produk/daftar" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-semibold text-sm transition duration-200">
                        Batal
                    </a>
                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-xl font-semibold text-sm transition duration-300 transform active:scale-95 shadow-md shadow-rose-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        
    </div>

</body>
</html>