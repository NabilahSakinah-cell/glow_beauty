<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Beri Penilaian</title>
</head>
<body class="bg-rose-50/30 p-10">
    <div class="max-w-md mx-auto p-8 bg-white rounded-3xl shadow-2xl border border-rose-100">
        <h2 class="text-2xl font-bold text-center mb-6 text-rose-600">Beri Penilaian</h2>
        <p class="text-center text-gray-500 mb-6">Pesanan ID: {{ $order->id_pesanan ?? 'N/A' }}</p>
        
        <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="id_pesanan" value="{{ $order->id_pesanan }}">
        
        <label class="block font-bold">Pilih Rating:</label>
        <div class="flex flex-row-reverse justify-end gap-1">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 peer-checked:text-amber-400 hover:text-amber-300 transition-colors">
                    ★
                </label>
            @endfor
        </div>

        <textarea name="komentar" placeholder="Tulis pengalamanmu..." class="w-full p-3 border rounded-xl" required></textarea>
        <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded-xl">Kirim Rating</button>
    </form>
    </div>
</body>
</html>