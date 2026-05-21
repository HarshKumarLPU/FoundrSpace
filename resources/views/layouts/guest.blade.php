<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FoundrSearch') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .bg-grid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
    </style>
</head>
<body class="font-sans text-slate-100 antialiased bg-slate-950 selection:bg-indigo-500 selection:text-white flex min-h-screen">

    <!-- Left Pane: Branding & Visuals (Hidden on Mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-950 border-r border-slate-800 flex-col justify-between">
        <div class="absolute inset-0 bg-grid z-0"></div>
        
        <!-- Animated Gradients -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] rounded-full bg-indigo-600/20 blur-[120px] animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-[10%] -right-[10%] w-[60%] h-[60%] rounded-full bg-cyan-600/10 blur-[100px] animate-pulse" style="animation-duration: 10s;"></div>
        </div>

        <div class="p-12 relative z-10">
            <a href="/" class="flex items-center gap-3 hover:opacity-90 transition-opacity w-fit">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-xl shadow-lg shadow-indigo-500/20">FS</div>
                <span class="font-heading font-extrabold text-2xl tracking-wide text-white">Foundr<span class="text-indigo-400">Search</span></span>
            </a>
        </div>

        <div class="p-12 relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold uppercase tracking-widest border border-indigo-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                The Startup Ecosystem
            </span>
            <h1 class="font-heading text-5xl font-black text-white mb-6 leading-tight tracking-tight">
                Connect. <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Build. Scale.</span>
            </h1>
            <p class="text-lg text-slate-400 leading-relaxed font-medium">
                Join the ultimate platform for visionary founders, forward-thinking investors, and elite talent shaping the future of technology.
            </p>
            
            <div class="mt-12 flex items-center gap-4">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800" src="https://i.pravatar.cc/100?img=1" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800" src="https://i.pravatar.cc/100?img=2" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-slate-950 bg-slate-800" src="https://i.pravatar.cc/100?img=3" alt="User">
                    <div class="w-10 h-10 rounded-full border-2 border-slate-950 bg-indigo-900/50 flex items-center justify-center text-xs font-bold text-indigo-300 backdrop-blur-sm border-indigo-500/30">
                        +5k
                    </div>
                </div>
                <p class="text-sm font-semibold text-slate-400">Active ecosystem members</p>
            </div>
        </div>
        
        <div class="p-12 relative z-10 text-sm font-medium text-slate-500">
            &copy; {{ date('Y') }} FoundrSearch Inc. All rights reserved.
        </div>
    </div>

    <!-- Right Pane: Auth Forms -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center relative overflow-hidden bg-slate-950">
        <!-- Mobile Logo (visible only on small screens) -->
        <div class="absolute top-8 left-8 lg:hidden z-20">
            <a href="/" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-sm shadow-lg shadow-indigo-500/20">FS</div>
                <span class="font-heading font-extrabold text-lg tracking-wide text-white">Foundr<span class="text-indigo-400">Search</span></span>
            </a>
        </div>
        
        <div class="w-full max-w-xl px-6 py-12 lg:px-12 relative z-10">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
