<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">
        Data Pesanan
    </h2>
</x-slot>

<div class="p-6 bg-rose-50 min-h-screen">

    <!-- Judul -->
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-pink-600">
            Admin Workspace - Data Pesanan 📜
        </h1>
        <p class="text-gray-500 mt-2">
            Kelola seluruh pesanan pelanggan Glow Beauty
        </p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-3xl shadow p-6">
            <p class="text-gray-500">Pesanan Baru</p>
            <h2 class="text-4xl font-bold text-yellow-500">12</h2>
        </div>

        <div class="bg-white rounded-3xl shadow p-6">
            <p class="text-gray-500">Diproses</p>
            <h2 class="text-4xl font-bold text-blue-500">8</h2>
        </div>

        <div class="bg-white rounded-3xl shadow p-6">
            <p class="text-gray-500">Dikirim</p>
            <h2 class="text-4xl font-bold text-pink-500">15</h2>
        </div>

        <div class="bg-white rounded-3xl shadow p-6">
            <p class="text-gray-500">Selesai</p>
            <h2 class="text-4xl font-bold text-green-500">210</h2>
        </div>

    </div>

    <!-- Filter -->
    <div class="bg-white rounded-3xl shadow p-6 mb-6">

        <div class="grid md:grid-cols-4 gap-4">

            <input
                type="text"
                placeholder="Cari ID Pesanan..."
                class="border rounded-xl p-3"
            >

            <select class="border rounded-xl p-3">
                <option>Semua Status</option>
                <option>Pending</option>
                <option>Diproses</option>
                <option>Dikirim</option>
                <option>Selesai</option>
            </select>

            <input
                type="date"
                class="border rounded-xl p-3"
            >

            <button
                class="bg-pink-500 hover:bg-pink-600 text-white rounded-xl">
                Export Data
            </button>

        </div>

    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-pink-50">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Pelanggan</th>
                    <th class="p-4 text-left">Produk</th>
                    <th class="p-4 text-left">Total</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t">
                    <td class="p-4">#GB-1001</td>
                    <td class="p-4">Maya Sari</td>
                    <td class="p-4">Glow Lip Tint</td>
                    <td class="p-4">Rp150.000</td>

                    <td class="p-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            Selesai
                        </span>
                    </td>

                    <td class="p-4 flex gap-2">

                        <button class="bg-pink-500 text-white px-4 py-2 rounded-lg">
                            Detail
                        </button>

                        <button class="bg-pink-700 text-white px-4 py-2 rounded-lg">
                            Update
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>