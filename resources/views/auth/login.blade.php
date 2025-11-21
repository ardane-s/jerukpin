<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JerukPin</title>
    
    @if(app()->environment('local'))
        {{-- Local development: use Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Production: use Tailwind CDN --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: '#f0fdf4',
                                100: '#dcfce7',
                                200: '#bbf7d0',
                                300: '#86efac',
                                400: '#4ade80',
                                500: '#10b981',
                                600: '#059669',
                                700: '#047857',
                                800: '#065f46',
                                900: '#064e3b',
                            },
                            secondary: {
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                            },
                            neutral: {
                                100: '#f5f5f5',
                                300: '#d4d4d4',
                                500: '#737373',
                                600: '#525252',
                                700: '#404040',
                                900: '#171717',
                            }
                        }
                    }
                }
            }
        </script>
    @endif
</head>
<body class="bg-neutral-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="text-4xl font-heading font-bold text-primary-500">
                🍊 JerukPin
            </a>
            <p class="text-neutral-600 mt-2">Jeruk Segar Berkualitas</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-neutral-900 mb-6 text-center">Masuk ke Akun</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-neutral-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-700">Lupa?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-neutral-300 text-primary-600 focus:ring-primary-500">
                    <label for="remember" class="ml-2 text-sm text-neutral-600">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white py-3 rounded-lg font-bold shadow-md transition">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-neutral-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-neutral-500">atau</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-neutral-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 font-medium">Daftar Sekarang</a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-sm text-neutral-500 hover:text-neutral-700">← Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
