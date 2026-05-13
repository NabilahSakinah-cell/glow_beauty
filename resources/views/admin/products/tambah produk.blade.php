<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Produk Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                {{-- PERHATIKAN: enctype="multipart/form-data" wajib ada! --}}
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                        <input type="number" name="harga" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Stok Awal</label>
                        <input type="number" name="stok" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    {{-- INI ADALAH INPUT GAMBAR BARU KITA --}}
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition">
                        Simpan Produk
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>