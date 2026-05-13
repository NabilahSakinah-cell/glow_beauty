<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .fade-in { animation: fadeIn 0.8s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-rose-50 antialiased min-h-screen flex flex-col justify-center items-center py-12 px-4 relative overflow-hidden">
    
    <div class="absolute top-0 right-0 w-64 h-64 bg-rose-200 rounded-full filter blur-3xl opacity-30 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-200 rounded-full filter blur-3xl opacity-30 -translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md bg-white/90 backdrop-blur-sm shadow-2xl rounded-[2.5rem] border border-rose-100 p-10 fade-in z-10">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-serif font-bold text-rose-600">Glow Beauty</h2>
            <p class="text-sm text-gray-400 mt-2 italic">Mulai perjalanan cantikmu di sini</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf <input type="hidden" name="role" value="pelanggan">

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-rose-800 uppercase tracking-widest mb-1 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-5 py-3 bg-rose-50/50 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-rose-800 uppercase tracking-widest mb-1 ml-1">Email</label>
                    <input type="email" name="email" required class="w-full px-5 py-3 bg-rose-50/50 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-rose-800 uppercase tracking-widest mb-1 ml-1">Password</label>
                    <input type="password" name="password" required class="w-full px-5 py-3 bg-rose-50/50 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-rose-800 uppercase tracking-widest mb-1 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-5 py-3 bg-rose-50/50 border border-rose-100 rounded-2xl focus:ring-2 focus:ring-rose-400 outline-none transition-all">
                </div>
            </div>

            <button type="submit" class="w-full mt-8 bg-rose-600 hover:bg-rose-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-rose-200 transition-all active:scale-95">
                Daftar Sekarang
            </button>
            
            <p class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-rose-600 font-bold hover:underline">Login</a>
            </p>
        </form>
    </div>
</body>
</html>