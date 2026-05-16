<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Akun - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-rose-50/50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-3xl border border-rose-100 w-full max-w-md shadow-xl shadow-rose-100/50 animate-fade-in">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-serif font-bold text-rose-600 mb-2">Glow Beauty 💄</h1>
            <p class="text-slate-400 text-sm">Selamat datang kembali, silakan masuk</p>
        </div>

        <form action="/login" method="POST" class="space-y-5">
            @csrf
            
            @if(session('success'))
                <div class="text-emerald-600 text-xs font-semibold text-center bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="text-red-600 text-xs font-semibold text-center bg-red-50 p-3 rounded-xl border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Email Anda</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-rose-100 bg-rose-50/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all text-sm" placeholder="nama@email.com" required>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-rose-100 bg-rose-50/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all text-sm" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-semibold py-3 rounded-xl transition duration-300 transform active:scale-95 shadow-md shadow-rose-200 text-sm">
                Masuk Akun 🛍️
            </button>
        </form>

        <div class="mt-8 text-center border-t border-rose-50 pt-4 text-xs text-slate-400">
            Belum punya akun? <a href="/register" class="text-rose-600 font-semibold hover:underline">Daftar sekarang</a>
        </div>
    </div>

</body>
</html>