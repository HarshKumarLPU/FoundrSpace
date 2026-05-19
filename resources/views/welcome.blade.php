<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FoundrSearch - Marketplace for Startups</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|inter:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .text-gradient {
            background: linear-gradient(to right, #a855f7, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-grid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 antialiased selection:bg-cyan-500 selection:text-white">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background glows -->
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-purple-600/20 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-600/20 blur-[120px] rounded-full pointer-events-none"></div>

        <!-- Navbar -->
        <header class="absolute top-0 left-0 right-0 z-50 p-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between glass-panel px-6 py-4 rounded-2xl shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-cyan-500 flex items-center justify-center font-bold text-white text-xl shadow-[0_0_15px_rgba(6,182,212,0.4)]">FS</div>
                    <span class="font-heading font-bold text-2xl tracking-wide text-white">Foundr<span class="text-cyan-400">Search</span></span>
                </div>
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-300">
                    <a href="{{ route('marketplace.index') }}" class="hover:text-cyan-400 transition-colors">Startups</a>
                    <a href="#" class="hover:text-cyan-400 transition-colors">Investors</a>
                    <a href="#" class="hover:text-cyan-400 transition-colors">Marketplace</a>
                    <a href="#" class="hover:text-cyan-400 transition-colors">Jobs</a>
                </nav>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium bg-white text-gray-900 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition-colors shadow-[0_0_15px_rgba(255,255,255,0.2)]">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium bg-gradient-to-r from-purple-600 to-cyan-500 text-white px-5 py-2.5 rounded-lg hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">Sign up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="relative z-10 pt-40 pb-20 px-6 sm:px-12 max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 min-h-screen">
            <div class="flex-1 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel text-xs font-semibold text-cyan-400 mb-8 border border-cyan-500/30">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                    </span>
                    The Ultimate Ecosystem
                </div>
                <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6 leading-[1.1]">
                    Where <span class="text-gradient">Startups</span><br />
                    Meet Growth.
                </h1>
                <p class="text-gray-400 text-lg sm:text-xl max-w-2xl mx-auto lg:mx-0 mb-10 leading-relaxed">
                    Connect with investors, hire top-tier talent, and sell your innovative products—all in one unified platform designed for the builders of tomorrow.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-5">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-purple-600 to-cyan-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform duration-300 shadow-[0_0_30px_rgba(6,182,212,0.3)] text-center flex items-center justify-center gap-2">
                        Launch Your Startup
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#" class="w-full sm:w-auto px-8 py-4 glass-panel text-white font-semibold rounded-xl hover:bg-white/10 transition-colors duration-300 text-center">
                        Explore Ecosystem
                    </a>
                </div>
                
                <div class="mt-16 flex items-center justify-center lg:justify-start gap-10 text-left">
                    <div>
                        <div class="font-heading text-4xl font-bold text-white">5K+</div>
                        <div class="text-sm text-gray-500 font-medium mt-1">Active Startups</div>
                    </div>
                    <div class="w-px h-12 bg-gray-800"></div>
                    <div>
                        <div class="font-heading text-4xl font-bold text-white">$200M</div>
                        <div class="text-sm text-gray-500 font-medium mt-1">Total Funded</div>
                    </div>
                    <div class="w-px h-12 bg-gray-800"></div>
                    <div>
                        <div class="font-heading text-4xl font-bold text-white">10K+</div>
                        <div class="text-sm text-gray-500 font-medium mt-1">Investors</div>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 relative w-full max-w-2xl lg:max-w-none lg:ml-10">
                <!-- Decorative element behind image -->
                <div class="absolute inset-0 bg-gradient-to-tr from-purple-500/20 to-cyan-500/20 rounded-[2rem] blur-3xl transform rotate-3 scale-105"></div>
                <!-- The Image -->
                <div class="relative z-10 rounded-[2rem] border border-gray-800 overflow-hidden shadow-2xl glass-panel p-2">
                     <img src="/images/hero.png" alt="Startup Ecosystem" class="w-full h-auto rounded-[1.5rem] object-cover aspect-square sm:aspect-[4/3] lg:aspect-square" />
                </div>
                
                <!-- Floating Glass Card -->
                <div class="absolute -bottom-6 -left-6 lg:-left-12 z-20 glass-panel p-5 rounded-2xl flex items-center gap-4 shadow-2xl animate-bounce" style="animation-duration: 4s;">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center shadow-[0_0_15px_rgba(52,211,153,0.4)]">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-white">Seed Funding Secured</div>
                        <div class="text-xs text-gray-400 mt-0.5">TechFlow Inc. just raised $2M</div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Background Grid overlay -->
        <div class="absolute inset-0 bg-grid opacity-20 pointer-events-none z-0"></div>
    </div>
</body>
</html>
