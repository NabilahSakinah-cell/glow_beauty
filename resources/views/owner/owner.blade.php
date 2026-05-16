<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Owner - Glow Beauty</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-rose-50/50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-3xl border border-rose-100 w-full max-w-md shadow-xl shadow-rose-100/50 animate-fade-in">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-serif font-bold text-rose-600 mb-2">Glow Beauty 💄</h1>
            <p class="text-slate-400 text-sm">Silakan masuk khusus untuk Ruang Kerja Owner 👑</p>
        </div>

        <form action="/login-owner" method="POST" class="space-y-5">
            @csrf
            
            @if($errors->any())
                <div class="text-red-600 text-xs font-semibold text-center bg-red-50 p-3 rounded-xl border border-red-100 animate-pulse">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Email Owner</label>
                <input type="email" name="email" class="w-full px-4 py-3 border border-rose-100 bg-rose-50/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all text-sm" placeholder="owner@glowbeauty.com" required>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-rose-100 bg-rose-50/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all text-sm" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl transition duration-300 transform active:scale-95 shadow-md shadow-rose-200 block text-center text-sm">
                Masuk sebagai Owner 👑
            </button>
        </form>

        <div class="mt-8 text-center border-t border-rose-50 pt-4">
            <a href="/" class="text-sm font-medium text-slate-400 hover:text-rose-600 transition flex items-center justify-center gap-2 transform hover:-translate-x-1 duration-200">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>

</body>
</html>