<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                {{-- Form Store Produk --}}
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf {{-- WAJIB: Tanpa ini akan error 419 Page Expired --}}

                    {{-- Nama Produk --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm @error('nama_produk') border-red-500 @enderror" required>
                        @error('nama_produk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm @error('category_id') border-red-500 @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Harga --}}
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                            <input type="number" name="harga" value="{{ old('harga') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm @error('harga') border-red-500 @enderror" required>
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Stok Awal</label>
                            <input type="number" name="stok" value="{{ old('stok') }}" 
                                class="w-full border-gray-300 rounded-md shadow-sm @error('stok') border-red-500 @enderror" required>
                            @error('stok')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Input Gambar --}}
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Gambar Produk</label>
                        <input type="file" name="gambar" accept="image/*" 
                            class="w-full border-gray-300 rounded-md shadow-sm mt-1 @error('gambar') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition font-semibold">
                            Simpan Produk
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="ml-4 text-sm text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>