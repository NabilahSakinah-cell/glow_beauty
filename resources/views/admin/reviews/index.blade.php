<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rating - Admin Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-rose-50/50 text-slate-800 p-8 min-h-screen">

<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <a href="/admin/dashboard" class="text-rose-600 hover:text-rose-700 transition flex items-center gap-2 text-sm font-medium mb-2">
            &larr; Kembali ke Dashboard
        </a>
        <h2 class="text-3xl font-bold text-rose-950">Daftar Rating Pelanggan ⭐</h2>
    </div>

    <div class="bg-white rounded-3xl overflow-hidden border border-rose-100 shadow-xl shadow-rose-100/50">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-rose-50 text-rose-900 font-semibold text-sm">
                        <th class="p-4 border-b border-rose-100">ID Pesanan</th>
                        <th class="p-4 border-b border-rose-100">Rating</th>
                        <th class="p-4 border-b border-rose-100">Komentar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-rose-50 text-sm">
                    @foreach($reviews as $review)
                    <tr class="hover:bg-rose-50/30">
                        <td class="p-4 font-semibold text-rose-950">#TRX{{ $review->id_pesanan }}</td>
                        <td class="p-4 font-bold text-yellow-500">{{ $review->rating }} ⭐</td>
                        <td class="p-4 text-slate-600">{{ $review->komentar }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>