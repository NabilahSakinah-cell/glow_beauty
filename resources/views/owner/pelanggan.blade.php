<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pelanggan - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-rose-50/30 p-6">

    <div class="max-w-6xl mx-auto bg-white p-8 rounded-3xl border border-rose-100 shadow-xl shadow-rose-100/40">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-rose-900 flex items-center gap-2">
                    Data Semua Pelanggan 👑
                </h1>
                <p class="text-slate-400 text-sm mt-1">Daftar pelanggan aktif yang terhubung dengan Glow Beauty</p>
            </div>
            <a href="{{ url()->previous() }}" class="bg-white hover:bg-rose-600 text-rose-600 hover:text-white px-5 py-2 rounded-full border border-rose-200 text-sm font-semibold transition-all duration-200">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-rose-50">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-rose-50/50 text-rose-950 text-sm font-semibold border-b border-rose-100">
                        <th class="p-4">No</th>
                        <th class="p-4">ID Pelanggan</th>
                        <th class="p-4">No. Telepon</th>
                        <th class="p-4">Alamat Rumah</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-rose-50/50">
                    @forelse($daftar_pelanggan as $index => $pelanggan)
                        <tr class="hover:bg-rose-50/20 transition">
                            <td class="p-4 font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-semibold text-slate-800">#PLG{{ $pelanggan->id_pelanggan }}</td>
                            <td class="p-4">{{ $pelanggan->no_telepon ?? '-' }}</td>
                            <td class="p-4">{{ $pelanggan->alamat ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-400 bg-slate-50/50">Belum ada data pelanggan yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>