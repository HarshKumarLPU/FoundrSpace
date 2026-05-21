<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
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
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .animate-float {
            animation: float-slow 5s ease-in-out infinite;
        }
        .delay-100 { animation-delay: 100ms; transition-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; transition-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; transition-delay: 300ms; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white flex flex-col min-h-screen relative overflow-x-hidden" x-data="{ mobileMenuOpen: false }">

    <!-- Top Navigation Header (Sticky Glass) -->
    <header class="w-full bg-slate-950/60 border-b border-slate-800/80 sticky top-0 z-50 backdrop-blur-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-lg shadow-lg shadow-indigo-500/20">FS</div>
                <span class="font-heading font-extrabold text-xl tracking-wide text-white">Foundr<span class="text-indigo-400">Search</span></span>
            </a>

            <!-- Desktop Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#startups" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Startups</a>
                <a href="#investors" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Investors</a>
                <a href="#jobs" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Jobs</a>
            </nav>

            <!-- Desktop Auth Controls -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-900/20 transition-all flex items-center gap-2 border border-indigo-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Console
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors px-3 py-2">Log in</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-500 hover:to-cyan-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-900/20 transition-all border border-indigo-500">Sign up</a>
                @endauth
            </div>

            <!-- Hamburger Button (Mobile) -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-slate-400 hover:text-white focus:outline-none z-50">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-40 flex bg-slate-950/85 backdrop-blur-sm" style="display: none;">
        <div class="w-64 bg-slate-900 border-r border-slate-800 h-full flex flex-col justify-between pt-24 pb-8 px-6">
            <nav class="space-y-2">
                <a @click="mobileMenuOpen = false" href="#startups" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Startups Marketplace
                </a>
                <a @click="mobileMenuOpen = false" href="#investors" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Investor Ecosystem
                </a>
                <a @click="mobileMenuOpen = false" href="#jobs" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Career Opportunities
                </a>
            </nav>

            <div class="border-t border-slate-800/60 pt-4 flex flex-col gap-2">
                @auth
                    <a @click="mobileMenuOpen = false" href="{{ url('/dashboard') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-xl transition-colors">Dashboard Console</a>
                @else
                    <a @click="mobileMenuOpen = false" href="{{ route('login') }}" class="w-full flex items-center justify-center py-2.5 text-sm font-semibold text-slate-400 hover:text-white transition-colors">Log in</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('register') }}" class="w-full flex items-center justify-center py-2.5 bg-slate-100 text-slate-950 font-bold text-sm rounded-xl transition-all">Sign up</a>
                @endauth
            </div>
        </div>
        <div class="flex-grow" @click="mobileMenuOpen = false"></div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow relative z-10">
        
        <!-- SECTION 1: HERO SECTION -->
        <section class="max-w-7xl mx-auto px-6 pt-20 pb-24 lg:pt-28 flex flex-col justify-center relative">
            <div class="absolute inset-0 bg-grid opacity-60 pointer-events-none z-0"></div>
            <!-- Ambient glows -->
            <div class="absolute top-[10%] left-[10%] w-[50%] h-[50%] bg-indigo-600/10 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[10%] right-[10%] w-[40%] h-[40%] bg-cyan-600/10 blur-[100px] rounded-full pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row items-center gap-16 py-8 w-full relative z-10">
                <!-- Left Info Column -->
                <div class="flex-1 text-center lg:text-left space-y-8 animate-on-scroll">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-950/50 border border-indigo-800/50 text-xs font-semibold text-indigo-300 backdrop-blur-sm mx-auto lg:mx-0">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        The Next-Gen Startup Ecosystem
                    </div>
                    
                    <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.1] max-w-2xl mx-auto lg:mx-0">
                        Where <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Visionaries</span><br />
                        Meet Growth.
                    </h1>
                    
                    <p class="text-slate-400 text-lg sm:text-xl max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Connect with verified investors, hire high-velocity talent, and showcase products—all inside a single collaborative terminal.
                    </p>
                    
                    <!-- Search Bar in Hero -->
                    <div class="max-w-xl mx-auto lg:mx-0 pt-2">
                        <form action="{{ route('marketplace.index') }}" method="GET" class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-500 group-focus-within:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" class="w-full pl-11 pr-32 py-4 bg-slate-900/60 border border-slate-700/50 rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 backdrop-blur-sm shadow-xl transition-all placeholder-slate-500" placeholder="Search startups, industries, or keywords...">
                            <button type="submit" class="absolute inset-y-2 right-2 px-6 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-colors shadow-md">
                                Discover
                            </button>
                        </form>
                    </div>

                    <!-- Animated Stats -->
                    <div class="pt-8 flex flex-wrap justify-center lg:justify-start gap-8 border-t border-slate-800/60">
                        <div class="flex flex-col" x-data="{ 
                            count: 0, 
                            target: 50,
                            startAnimation() {
                                let current = 0;
                                let step = this.target / 30;
                                let interval = setInterval(() => {
                                    if(current >= this.target) {
                                        clearInterval(interval);
                                        this.count = this.target;
                                    } else {
                                        current += step;
                                        this.count = Math.floor(current);
                                    }
                                }, 30);
                            }
                        }" x-init="
                            let observer = new IntersectionObserver((entries) => {
                                if(entries[0].isIntersecting) { startAnimation(); observer.disconnect(); }
                            });
                            observer.observe($el);
                        ">
                            <div class="font-heading text-4xl font-black text-white flex items-baseline">
                                $<span x-text="count"></span>M<span class="text-indigo-400">+</span>
                            </div>
                            <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest mt-1">Capital Raised</div>
                        </div>

                        <div class="flex flex-col" x-data="{ 
                            count: 0, 
                            target: 15,
                            startAnimation() {
                                let current = 0;
                                let step = this.target / 30;
                                let interval = setInterval(() => {
                                    if(current >= this.target) {
                                        clearInterval(interval);
                                        this.count = this.target;
                                    } else {
                                        current += step;
                                        this.count = Math.floor(current);
                                    }
                                }, 30);
                            }
                        }" x-init="
                            let observer = new IntersectionObserver((entries) => {
                                if(entries[0].isIntersecting) { startAnimation(); observer.disconnect(); }
                            });
                            observer.observe($el);
                        ">
                            <div class="font-heading text-4xl font-black text-white flex items-baseline">
                                <span x-text="count"></span>k<span class="text-cyan-400">+</span>
                            </div>
                            <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest mt-1">Active Founders</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Illustration Column -->
                <div class="flex-1 relative w-full max-w-lg lg:max-w-none animate-on-scroll delay-200">
                    <div class="relative z-10 glass-panel p-2 rounded-2xl shadow-2xl animate-float">
                        <div class="flex items-center gap-2 border-b border-slate-700/50 pb-2 pt-1 px-3 bg-slate-900/40 rounded-t-xl">
                            <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                        </div>
                        <img src="/images/hero.png" onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop'" alt="Platform Dashboard" class="w-full h-auto rounded-b-xl border-t border-slate-700/50 object-cover aspect-[4/3] bg-slate-900 opacity-90" />
                    </div>
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 lg:-left-12 z-20 glass-panel p-4 rounded-xl flex items-center gap-3 shadow-[0_0_30px_rgba(0,0,0,0.5)] border border-slate-700/50 animate-float" style="animation-delay: 2s;">
                        <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white">Seed Round Closed</div>
                            <div class="text-[10px] text-slate-400 font-medium">NexusAI secured $3.2M</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: HOW IT WORKS (CARDS) -->
        <section class="py-24 bg-slate-900/30 border-y border-slate-800/60 relative">
            <div class="max-w-7xl mx-auto px-6 space-y-16 relative z-10">
                <div class="text-center max-w-3xl mx-auto space-y-4 animate-on-scroll">
                    <span class="text-xs uppercase tracking-widest text-indigo-400 font-bold">Simple Workflow</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white">Three Steps to Scale</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-on-scroll">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 text-indigo-400 flex items-center justify-center mb-6 shadow-lg shadow-indigo-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-white mb-3">1. Build Your Profile</h4>
                        <p class="text-slate-400 leading-relaxed text-sm">Register as a founder, investor, or talent. Upload your pitch decks, portfolios, and verify your credentials.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-on-scroll delay-100">
                        <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 border border-cyan-500/30 text-cyan-400 flex items-center justify-center mb-6 shadow-lg shadow-cyan-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-white mb-3">2. Discover Opportunities</h4>
                        <p class="text-slate-400 leading-relaxed text-sm">Navigate curated dealflows, discover high-potential startups, and browse exclusive tech career listings.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="glass-panel p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300 animate-on-scroll delay-200">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/10">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-white mb-3">3. Connect & Scale</h4>
                        <p class="text-slate-400 leading-relaxed text-sm">Engage directly through the platform. Secure seed funding, hire your founding engineers, and accelerate growth.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: ALTERNATING SHOWCASE -->
        <section class="py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 space-y-32">
                
                <!-- 1. Startups (Text Left, Image Right) -->
                <div id="startups" class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 scroll-mt-24">
                    <div class="flex-1 space-y-6 animate-on-scroll">
                        <span class="px-3 py-1 bg-indigo-900/30 border border-indigo-800/50 rounded-full text-xs font-semibold text-indigo-400">For Founders</span>
                        <h3 class="text-3xl sm:text-4xl font-heading font-extrabold text-white leading-tight">Elevate Your Startup Presence</h3>
                        <p class="text-slate-400 leading-relaxed text-lg">
                            Build a comprehensive profile containing your seed funding stage, logo assets, and company description. Publish a detailed catalog of products and services to trade within our community.
                        </p>
                        <ul class="space-y-4 pt-2">
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Standardized Product & Service catalogs</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-indigo-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Earn the Verified Badge through Admin Moderation</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 w-full animate-on-scroll delay-200">
                        <div class="relative rounded-2xl glass-panel p-2 shadow-2xl">
                            <img src="/images/startups_showcase.png" onerror="this.src='https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop'" alt="Startups Mockup" class="w-full h-auto rounded-xl object-cover">
                        </div>
                    </div>
                </div>

                <!-- 2. Investors (Image Left, Text Right) -->
                <div id="investors" class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 scroll-mt-24">
                    <div class="flex-1 w-full order-2 lg:order-1 animate-on-scroll delay-200">
                        <div class="relative rounded-2xl glass-panel p-2 shadow-2xl">
                            <img src="/images/investor_dealflow.png" onerror="this.src='https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?q=80&w=2070&auto=format&fit=crop'" alt="Investors Mockup" class="w-full h-auto rounded-xl object-cover">
                        </div>
                    </div>
                    <div class="flex-1 space-y-6 order-1 lg:order-2 animate-on-scroll">
                        <span class="px-3 py-1 bg-emerald-900/30 border border-emerald-800/50 rounded-full text-xs font-semibold text-emerald-400">For Investors</span>
                        <h3 class="text-3xl sm:text-4xl font-heading font-extrabold text-white leading-tight">Access Proprietary Dealflow</h3>
                        <p class="text-slate-400 leading-relaxed text-lg">
                            Unlock exclusive capital pipelines. Verified venture funds and angel networks gain immediate access to dealflow, review direct funding requests, and review PDF pitch decks.
                        </p>
                        <ul class="space-y-4 pt-2">
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Review PDF Pitch Deck submissions instantly</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Direct connection to high-growth founder teams</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 3. Jobs (Text Left, Image Right) -->
                <div id="jobs" class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 scroll-mt-24">
                    <div class="flex-1 space-y-6 animate-on-scroll">
                        <span class="px-3 py-1 bg-cyan-900/30 border border-cyan-800/50 rounded-full text-xs font-semibold text-cyan-400">For Talent</span>
                        <h3 class="text-3xl sm:text-4xl font-heading font-extrabold text-white leading-tight">Careers & Mentorship Portal</h3>
                        <p class="text-slate-400 leading-relaxed text-lg">
                            Accelerate your career by joining high-velocity startups. Freelancers and mentors can search job boards, submit cover letters, and attach PDF resumes.
                        </p>
                        <ul class="space-y-4 pt-2">
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Interactive hiring application tracker</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center shrink-0 mt-0.5"><svg class="w-3.5 h-3.5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                <span class="text-slate-300 font-medium">Post and view active job openings seamlessly</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 w-full animate-on-scroll delay-200">
                        <div class="relative rounded-2xl glass-panel p-2 shadow-2xl">
                            <img src="/images/jobs_portal.png" onerror="this.src='https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop'" alt="Jobs Mockup" class="w-full h-auto rounded-xl object-cover">
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION 4: TESTIMONIALS -->
        <section class="py-24 bg-slate-900/30 border-y border-slate-800/60 relative">
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-16 animate-on-scroll">
                    <span class="text-xs uppercase tracking-widest text-indigo-400 font-bold">Community Trust</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white">Loved by Builders</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Testimonial 1 -->
                    <div class="glass-panel p-8 rounded-2xl animate-on-scroll">
                        <div class="flex items-center gap-1 text-amber-400 mb-6">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-slate-300 italic mb-6 leading-relaxed">"FoundrSearch completely changed how we raised our Seed round. Within 2 weeks of getting our Verified Badge, we connected with three tier-1 funds."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/150?img=47" class="w-10 h-10 rounded-full border border-slate-700" alt="Sarah J.">
                            <div>
                                <div class="font-bold text-white text-sm">Sarah Jenkins</div>
                                <div class="text-xs text-slate-500 font-medium">CEO, DataFlow AI</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="glass-panel p-8 rounded-2xl animate-on-scroll delay-100">
                        <div class="flex items-center gap-1 text-amber-400 mb-6">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-slate-300 italic mb-6 leading-relaxed">"As a partner at a venture fund, the dealflow here is unmatched. The PDF pitch decks and structured profiles save our team hours of due diligence."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/150?img=11" class="w-10 h-10 rounded-full border border-slate-700" alt="Marcus T.">
                            <div>
                                <div class="font-bold text-white text-sm">Marcus Trevino</div>
                                <div class="text-xs text-slate-500 font-medium">Partner, Apex Ventures</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="glass-panel p-8 rounded-2xl animate-on-scroll delay-200">
                        <div class="flex items-center gap-1 text-amber-400 mb-6">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-slate-300 italic mb-6 leading-relaxed">"I found my dream role as a Lead Engineer here. The career portal cuts out the noise and connects you directly with top-tier YC-backed founders."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/150?img=33" class="w-10 h-10 rounded-full border border-slate-700" alt="Elena R.">
                            <div>
                                <div class="font-bold text-white text-sm">Elena Rodriguez</div>
                                <div class="text-xs text-slate-500 font-medium">Senior Engineer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5: FAQ ACCORDION -->
        <section class="py-24">
            <div class="max-w-3xl mx-auto px-6">
                <div class="text-center space-y-4 mb-16 animate-on-scroll">
                    <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white">Frequently Asked Questions</h2>
                    <p class="text-slate-400">Everything you need to know about the platform.</p>
                </div>

                <div class="space-y-4 animate-on-scroll" x-data="{ active: 1 }">
                    <!-- FAQ 1 -->
                    <div class="glass-panel border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300">
                        <button @click="active = (active === 1 ? null : 1)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                            <span class="font-bold text-white text-lg">Is FoundrSearch free for founders?</span>
                            <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300" :class="{'rotate-180': active === 1}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 1" x-collapse>
                            <div class="p-6 pt-0 text-slate-400 leading-relaxed">
                                Yes! Creating a basic profile, uploading your pitch deck, and posting initial job listings is completely free. We offer premium tiers for advanced analytics and priority listing placement.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="glass-panel border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300">
                        <button @click="active = (active === 2 ? null : 2)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                            <span class="font-bold text-white text-lg">How do I get the "Verified" badge?</span>
                            <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300" :class="{'rotate-180': active === 2}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 2" x-collapse style="display: none;">
                            <div class="p-6 pt-0 text-slate-400 leading-relaxed">
                                All startups are automatically submitted to our moderation queue upon profile completion. Our admin team reviews your submitted documents (incorporation, funding history) and typically grants the badge within 48 hours.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="glass-panel border border-slate-800 rounded-2xl overflow-hidden transition-all duration-300">
                        <button @click="active = (active === 3 ? null : 3)" class="flex justify-between items-center w-full p-6 text-left focus:outline-none">
                            <span class="font-bold text-white text-lg">Who has access to my Pitch Deck?</span>
                            <svg class="w-5 h-5 text-slate-400 transform transition-transform duration-300" :class="{'rotate-180': active === 3}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 3" x-collapse style="display: none;">
                            <div class="p-6 pt-0 text-slate-400 leading-relaxed">
                                You have full control over privacy. You can choose to make your deck public to all registered users, restrict it exclusively to "Verified Investors", or require an access request before viewing.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 6: CTA BANNER -->
        <section class="py-28 text-center max-w-5xl mx-auto px-6 space-y-8 relative">
            <div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] bg-indigo-600/10 blur-[100px] rounded-full pointer-events-none"></div>
            
            <h2 class="font-heading text-4xl sm:text-5xl font-extrabold text-white leading-tight animate-on-scroll">Ready to Scale Your Concept?</h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed animate-on-scroll delay-100">
                Join thousands of builders already using FoundrSearch to raise capital, hire elite talent, and scale their MRR.
            </p>
            <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center items-center animate-on-scroll delay-200">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-500 hover:to-cyan-500 text-white font-extrabold rounded-xl shadow-lg shadow-indigo-900/20 transition-all active:scale-95 text-sm">
                    Create Free Profile
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl border border-slate-700 hover:border-slate-600 shadow-sm transition-colors text-sm">
                    Console Sign In
                </a>
            </div>
        </section>

    </main>

    <!-- Premium Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-950 pt-16 pb-8 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-16">
                <!-- Brand Column -->
                <div class="col-span-2 lg:col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-sm shadow-md">FS</div>
                        <span class="font-heading font-extrabold text-lg tracking-wide text-white">Foundr<span class="text-indigo-400">Search</span></span>
                    </a>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm mb-6">
                        The unified ecosystem where visionary founders, investors, and elite talent connect to build the future of technology.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-slate-500 hover:text-indigo-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-indigo-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm3.98-10.842a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/></svg>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-indigo-400 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Product Column -->
                <div>
                    <h4 class="font-bold text-white mb-4">Platform</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('marketplace.index') }}" class="text-slate-400 hover:text-white transition-colors">Startups</a></li>
                        <li><a href="{{ route('investors.index') }}" class="text-slate-400 hover:text-white transition-colors">Investors</a></li>
                        <li><a href="{{ route('jobs.index') }}" class="text-slate-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Pricing</a></li>
                    </ul>
                </div>
                
                <!-- Resources Column -->
                <div>
                    <h4 class="font-bold text-white mb-4">Resources</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">API Reference</a></li>
                    </ul>
                </div>
                
                <!-- Legal Column -->
                <div>
                    <h4 class="font-bold text-white mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800/80 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-xs">
                    &copy; {{ date('Y') }} FoundrSearch Inc. All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    All systems operational
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button 
        x-data="{ show: false }" 
        @scroll.window="show = window.pageYOffset > 500" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 z-50 p-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-full shadow-lg shadow-indigo-500/20 transition-colors focus:outline-none"
        style="display: none;">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
    </button>

    <!-- Vanilla JS Scroll Animations Observer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-on-scroll').forEach((el) => {
                el.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-1000', 'ease-out');
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
