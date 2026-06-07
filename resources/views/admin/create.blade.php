<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Produk | Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-rose-50 font-[Poppins] p-4 md:p-8">

    <div class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow-md border border-rose-100">
        
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ url('/admin/dashboard') }}" class="text-rose-600 hover:text-rose-800 transition bg-rose-50 hover:bg-rose-100 p-2.5 h-10 w-10 flex items-center justify-center rounded-xl">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h2 class="text-lg font-bold text-rose-900 leading-tight">Tambah Produk Baru</h2>
                <p class="text-xs text-gray-400">Kelola katalog toko kosmetikmu</p>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-base text-emerald-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl mb-6 text-sm">
                <div class="flex items-center gap-2 mb-2 font-semibold">
                    <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                    <span>Periksa Kembali Inputan Anda:</span>
                </div>
                <ul class="list-disc pl-5 space-y-1 text-xs text-amber-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/admin/produk/simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700">Nama Produk</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Skintific Cushion" class="w-full mt-1 p-3 border border-rose-100 bg-rose-50/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-300 transition text-sm text-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: Serum / Sunscreen / Makeup" class="w-full mt-1 p-3 border border-rose-100 bg-rose-50/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-300 transition text-sm text-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 150000" class="w-full mt-1 p-3 border border-rose-100 bg-rose-50/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-300 transition text-sm text-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Foto Produk</label>
                <input type="file" name="foto" id="inputFoto" accept="image/*" class="w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-100 file:text-rose-700 hover:file:bg-rose-200 file:cursor-pointer file:transition" required>
                <p class="text-xs text-gray-400 mt-1">*Format gambar: JPG, JPEG, PNG, atau WEBP (Maks. 2MB)</p>
                
                <div id="boxPreview" class="hidden mt-4 border border-dashed border-rose-200 p-2 rounded-xl bg-rose-50/20 max-w-[200px]">
                    <p class="text-[10px] font-semibold text-rose-400 mb-1">Pratinjau Foto:</p>
                    <img id="previewFoto" src="#" alt="Pratinjau" class="w-full h-auto aspect-square object-cover rounded-lg shadow-sm">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-4 rounded-xl shadow-sm transition hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Simpan & Upload Produk
                </button>
            </div>
        </form>
    </div>

    <script>
        const inputFoto = document.getElementById('inputFoto');
        const boxPreview = document.getElementById('boxPreview');
        const previewFoto = document.getElementById('previewFoto');

        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                boxPreview.classList.remove('hidden');
                
                reader.addEventListener('load', function() {
                    previewFoto.setAttribute('src', this.result);
                });
                
                reader.readAsDataURL(file);
            } else {
                boxPreview.classList.add('hidden');
                previewFoto.setAttribute('src', '#');
            }
        });
    </script>
</body>
</html>