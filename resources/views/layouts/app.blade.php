<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Rafa Kasir</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-mint-50 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-mint-100 flex-shrink-0 hidden md:flex flex-col">
        <div class="p-6 border-b border-mint-100">
            <h1 class="text-2xl font-bold text-mint-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Rafa Kasir
            </h1>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('barang.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('barang.*') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Barang
                </a>
                <a href="{{ route('stok.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('stok.index') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Stok Barang
                </a>
                <a href="{{ route('user.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('user.*') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Petugas
                </a>
            @else
                <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('petugas.dashboard') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('kasir.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('kasir.index') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Kasir
                </a>
                <a href="{{ route('petugas.barang.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('petugas.barang.index') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Daftar Barang
                </a>
                <a href="{{ route('petugas.stok.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('petugas.stok.index') ? 'bg-mint-400 text-gray-900 font-semibold' : 'text-gray-600 hover:bg-mint-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Update Stok
                </a>
            @endif
        </nav>
        <div class="p-4 border-t border-mint-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full rounded-xl text-red-500 hover:bg-red-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="bg-white border-b border-mint-100 px-8 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-700">@yield('title')</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full uppercase">{{ Auth::user()->role }}</span>
                <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="bg-mint-100 border border-mint-200 text-mint-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button @click="$el.parentElement.remove()" class="text-mint-600 hover:text-mint-800 font-bold">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6 flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button @click="$el.parentElement.remove()" class="text-red-600 hover:text-red-800 font-bold">&times;</button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
