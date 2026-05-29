<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FoundrSearch</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|inter:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(24, 24, 27, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .bg-grid {
            background-size: 30px 30px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-slate-100 selection:text-slate-950 flex flex-col md:flex-row min-h-screen" x-data="{ mobileMenuOpen: false }">

    <!-- Background Grid overlay -->
    <div class="absolute inset-0 bg-grid opacity-60 pointer-events-none z-0"></div>

    <!-- Desktop Sidebar -->
    <aside class="hidden md:flex flex-col w-72 bg-slate-900 border-r border-slate-800/80 h-screen sticky top-0 left-0 z-30 flex-shrink-0 justify-between">
        <div class="flex flex-col flex-grow">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="px-6 py-6 border-b border-slate-800/60 flex items-center gap-3 hover:opacity-90 transition-opacity">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-100 to-slate-300 flex items-center justify-center font-bold text-slate-950 text-lg shadow-sm">FS</div>
                <span class="font-heading font-extrabold text-xl tracking-wide text-slate-100">Foundr<span class="text-slate-400">Search</span></span>
            </a>

            @auth
            <!-- User Context / Role Badge -->
            <div class="px-6 py-4 border-b border-slate-800/40 bg-slate-900/20">
                <div class="font-semibold text-slate-200 text-sm truncate">{{ Auth::user()->name }}</div>
                <div class="text-xs text-slate-500 font-medium capitalize mt-0.5">{{ str_replace('_', ' ', Auth::user()->role) }} Console</div>
            </div>
            @else
            <!-- User Context / Role Badge -->
            <div class="px-6 py-4 border-b border-slate-800/40 bg-slate-900/20">
                <div class="font-semibold text-slate-200 text-sm truncate">Guest Mode</div>
                <div class="text-xs text-slate-500 font-medium capitalize mt-0.5">Public Access</div>
            </div>
            @endauth

            <!-- Navigation Links -->
            <nav class="flex-grow px-4 py-6 space-y-1.5">
                @auth
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'bg-indigo-600/20 text-indigo-400 shadow-sm border border-indigo-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard Home
                </a>
                
                <div class="h-px bg-slate-800/60 my-4 mx-2"></div>
                @endauth

                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'customer', 'investor', 'startup_owner', 'freelancer']))
                <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('marketplace.*') ? 'bg-blue-600/20 text-blue-400 shadow-sm border border-blue-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Marketplace Directory
                </a>
                @endif
                
                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'investor', 'startup_owner']))
                <a href="{{ route('investors.index') }}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('investors.*') ? 'bg-emerald-600/20 text-emerald-400 shadow-sm border border-emerald-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Investor Ecosystem
                </a>
                @endif
                
                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'freelancer', 'startup_owner']))
                <a href="{{ route('jobs.index') }}" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('jobs.*') ? 'bg-violet-600/20 text-violet-400 shadow-sm border border-violet-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Career Opportunities
                </a>
                @endif
            </nav>
        </div>

        <!-- Sidebar Footer / Profile -->
        <div class="p-4 border-t border-slate-800/60 bg-slate-900/40 flex flex-col gap-2">
            @auth
                <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors">
                    Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-850 hover:bg-slate-800 text-slate-300 font-semibold text-sm rounded-xl border border-slate-800 transition-colors shadow-sm">
                        Log Out
                    </button>
                </form>
            @else
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center py-2.5 text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center py-2.5 bg-slate-100 hover:bg-white text-slate-950 font-bold text-sm rounded-xl transition-all shadow-sm">Sign up</a>
                </div>
            @endauth
        </div>
    </aside>

    <!-- Mobile Header -->
    <header class="flex md:hidden justify-between items-center bg-slate-900 border-b border-slate-800/80 px-6 py-4 fixed top-0 left-0 right-0 z-40 h-16">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-slate-100 to-slate-300 flex items-center justify-center font-bold text-slate-950 text-sm shadow-sm">FS</div>
            <span class="font-heading font-extrabold text-lg tracking-wide text-slate-100">Foundr<span class="text-slate-400">Search</span></span>
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-400 hover:text-slate-100 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
            </svg>
        </button>
    </header>

    <!-- Mobile Drawer -->
    <div x-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-35 flex bg-slate-950/80 backdrop-blur-sm" style="display: none;">
        <div class="w-64 bg-slate-900 border-r border-slate-800 h-full flex flex-col justify-between pt-20 pb-6 px-4 animate-slide-in">
            <nav class="space-y-1">
                @auth
                <a @click="mobileMenuOpen = false" href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl {{ request()->routeIs('dashboard') || request()->routeIs('*.dashboard') ? 'bg-indigo-600/20 text-indigo-400 border border-indigo-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard Home
                </a>
                <div class="h-px bg-slate-800/60 my-2 mx-2"></div>
                @endauth
                
                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'customer', 'investor', 'startup_owner', 'freelancer']))
                <a @click="mobileMenuOpen = false" href="{{ route('marketplace.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl {{ request()->routeIs('marketplace.*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Marketplace Directory
                </a>
                @endif
                
                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'investor', 'startup_owner']))
                <a @click="mobileMenuOpen = false" href="{{ route('investors.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl {{ request()->routeIs('investors.*') ? 'bg-emerald-600/20 text-emerald-400 border border-emerald-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20H7m10 0v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Investor Ecosystem
                </a>
                @endif
                
                @if(!auth()->check() || in_array(auth()->user()->role, ['admin', 'freelancer', 'startup_owner']))
                <a @click="mobileMenuOpen = false" href="{{ route('jobs.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl {{ request()->routeIs('jobs.*') ? 'bg-violet-600/20 text-violet-400 border border-violet-500/30' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/40' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Career Opportunities
                </a>
                @endif
            </nav>

            <div class="mt-auto border-t border-slate-800/60 pt-4 flex flex-col gap-2">
                @auth
                    <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-400 hover:text-slate-100 transition-colors">
                        Edit Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-850 hover:bg-slate-800 text-slate-300 font-semibold text-sm rounded-xl border border-slate-800 transition-colors shadow-sm">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full text-center py-2 text-sm font-semibold text-slate-400 hover:text-slate-100">Log in</a>
                    <a href="{{ route('register') }}" class="w-full text-center py-2.5 bg-slate-100 text-slate-950 font-bold text-sm rounded-xl">Sign up</a>
                @endauth
            </div>
        </div>
        <!-- Tap off close -->
        <div class="flex-grow" @click="mobileMenuOpen = false"></div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col w-full md:min-w-0 pt-16 md:pt-0 relative z-10">
        <main class="flex-grow p-6 md:p-12">
            {{ $slot }}
        </main>
        
        <footer class="py-8 border-t border-slate-900/60 text-center text-slate-500 text-xs mt-auto">
            &copy; {{ date('Y') }} FoundrSearch. All rights reserved.
        </footer>
    </div>

</body>
</html>
