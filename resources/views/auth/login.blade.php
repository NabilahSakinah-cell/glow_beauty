<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .fade-in { animation: fadeIn 0.8s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body class="bg-rose-50 antialiased min-h-screen flex flex-col justify-center items-center py-12 px-4 relative overflow-hidden">
    
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-rose-200 rounded-full filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm shadow-2xl rounded-[2.5rem] border border-rose-100 p-10 fade-in z-10">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-serif font-bold text-rose-600">Glow Beauty</h2>
            <p class="text-sm text-gray-400 mt-2 italic">Selamat datang kembali, Cantik!</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-600 text-xs rounded-2xl border border-red-100 font-medium">
            ⚠️ {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-rose-800 uppercase tracking-widest mb-1 ml-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-5 py-4 bg-rose-50/30 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all placeholder:text-gray-300" placeholder="nama@email.com">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1 ml-1">
                        <label class="text-xs font-bold text-rose-800 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[10px] text-rose-400 font-bold hover:text-rose-600 uppercase">Lupa?</a>
                    </div>
                    <input type="password" name="password" required class="w-full px-5 py-4 bg-rose-50/30 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all placeholder:text-gray-300" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full mt-10 bg-rose-600 hover:bg-rose-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-rose-200 transition-all active:scale-95">
                Masuk ke Dashboard
            </button>
            
            <p class="mt-8 text-center text-sm text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-rose-600 font-bold hover:underline">Daftar Akun</a>
            </p>
        </form>
    </div>

    <footer class="mt-8 text-[10px] text-rose-300 uppercase tracking-[0.2em] font-bold z-10">
        &copy; 2026 ITH - Glow Beauty Project
    </footer>
</body>
</html>