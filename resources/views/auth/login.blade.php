<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rafa Kasir</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-mint-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-10 border border-mint-100">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-mint-400 rounded-2xl mb-4 shadow-lg shadow-mint-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Rafa Kasir</h1>
            <p class="text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 focus:border-mint-400 outline-none transition" placeholder="nama@email.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 focus:border-mint-400 outline-none transition" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 rounded-xl transition duration-300 shadow-lg shadow-mint-100 transform active:scale-[0.98]">
                Masuk
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Rafa Kasir. All rights reserved.
        </p>
    </div>
</body>
</html>
