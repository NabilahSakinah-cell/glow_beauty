<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Owner - Glow Beauty</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-rose-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-rose-100 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif font-bold text-rose-600 mb-2">Glow Beauty</h1>
            <p class="text-gray-500">Silakan masuk khusus untuk Owner</p>
        </div>

        <form action="/login-owner" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="mb-4 text-red-600 text-sm font-medium text-center bg-red-50 p-2 rounded-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Owner</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-rose-500 focus:border-rose-500" placeholder="nama@email.com" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-rose-500 focus:border-rose-500" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-rose-600 text-white font-medium py-2.5 rounded-lg hover:bg-rose-700 transition shadow-md shadow-rose-200">
                Masuk sebagai Owner
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/" class="text-sm text-gray-500 hover:text-rose-600">&larr; Kembali ke Halaman Utama</a>
        </div>
    </div>

</body>
</html>