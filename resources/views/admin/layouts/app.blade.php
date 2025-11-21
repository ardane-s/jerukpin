<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - JerukPin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .gradient-animate {
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 to-orange-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-orange-500 to-orange-600 shadow-lg gradient-animate">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-heading font-bold text-white flex items-center gap-2 hover:scale-105 transition-transform">
                            <span class="text-3xl">🍊</span>
                            <span>JerukPin Admin</span>
                        </a>
                    </div>
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-1">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            📊 Dashboard
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            📁 Kategori
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.products.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            🍊 Produk
                        </a>
                        <a href="{{route('admin.flash-sales.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.flash-sales.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            ⚡ Flash Sale
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.orders.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            📦 Pesanan
                        </a>
                        <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.reviews.*') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                            ⭐ Review
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm text-white/80 hover:text-white transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Lihat Toko
                    </a>
                    <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-lg">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-orange-500 font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm text-white font-medium">{{ auth()->user()->name }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg shadow-sm flex items-center gap-3">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg shadow-sm flex items-center gap-3">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto py-6 text-center text-neutral-500 text-sm">
        <p>© 2025 JerukPin Admin Panel. Made with 🍊 and ❤️</p>
    </footer>
</body>
</html>
