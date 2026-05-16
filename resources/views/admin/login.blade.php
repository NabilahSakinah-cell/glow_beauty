<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Glow Beauty</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-rose-50/50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-rose-100 w-full max-w-md relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-rose-600"></div>

        <div class="text-center mb-8 mt-2">
            <h1 class="text-3xl font-bold text-rose-900 mb-2">Glow Beauty</h1>
            <p class="text-rose-600 font-medium bg-rose-50 inline-block px-4 py-1 rounded-full text-sm">Portal Admin Workspace 🛠️</p>
        </div>

        <form action="/login-admin" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="mb-5 text-red-600 text-sm font-medium text-center bg-red-50 p-3 rounded-lg border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">Email Admin</label>
                <input type="email" name="email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-rose-600 focus:border-rose-600 transition" placeholder="admin@email.com" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:bg-white focus:ring-2 focus:ring-rose-600 focus:border-rose-600 transition" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-rose-600 text-white font-semibold py-3 rounded-lg hover:bg-rose-700 transition shadow-md shadow-rose-200">
                Masuk ke Sistem Admin
            </button>
        </form>

        <div class="mt-8 text-center border-t border-slate-100 pt-5">
            <a href="/" class="text-sm text-slate-500 hover:text-rose-600 transition">&larr; Kembali ke Halaman Utama</a>
        </div>
    </div>

</body>
</html>