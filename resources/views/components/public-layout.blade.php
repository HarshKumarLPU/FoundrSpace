<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace - FoundrSearch</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|inter:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 antialiased selection:bg-cyan-500 selection:text-white">
    <div class="relative min-h-screen flex flex-col overflow-hidden">
        
        <!-- Navbar -->
        <header class="relative z-50 p-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between glass-panel px-6 py-4 rounded-2xl shadow-lg">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-cyan-500 flex items-center justify-center font-bold text-white text-xl shadow-[0_0_15px_rgba(6,182,212,0.4)]">FS</div>
                    <span class="font-heading font-bold text-2xl tracking-wide text-white">Foundr<span class="text-cyan-400">Search</span></span>
                </a>
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-300">
                    <a href="{{ route('marketplace.index') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('marketplace.*') ? 'text-cyan-400' : '' }}">Startups</a>
                    <a href="#" class="hover:text-cyan-400 transition-colors">Investors</a>
                    <a href="{{ route('jobs.index') }}" class="hover:text-cyan-400 transition-colors {{ request()->routeIs('jobs.*') ? 'text-cyan-400' : '' }}">Jobs</a>
                </nav>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium bg-white text-gray-900 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition-colors shadow-[0_0_15px_rgba(255,255,255,0.2)]">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-gradient-to-r from-purple-600 to-cyan-500 text-white px-5 py-2.5 rounded-lg hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">Sign up</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow relative z-10">
            {{ $slot }}
        </main>
        
        <footer class="mt-20 py-8 border-t border-gray-800 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} FoundrSearch. All rights reserved.
        </footer>
    </div>
</body>
</html>
