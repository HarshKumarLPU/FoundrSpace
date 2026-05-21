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
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float-slow 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-slate-100 selection:text-slate-950 flex flex-col min-h-screen relative" x-data="{ mobileMenuOpen: false }">

    <!-- Background Grid overlay -->
    <div class="absolute inset-0 bg-grid opacity-60 pointer-events-none z-0"></div>

    <!-- Top Navigation Header -->
    <header class="w-full bg-slate-900/40 border-b border-slate-800/80 sticky top-0 z-40 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-100 to-slate-300 flex items-center justify-center font-bold text-slate-950 text-lg shadow-sm">FS</div>
                <span class="font-heading font-extrabold text-xl tracking-wide text-slate-100">Foundr<span class="text-slate-400">Search</span></span>
            </a>

            <!-- Desktop Links -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('marketplace.index') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Startups</a>
                <a href="{{ route('investors.index') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Investors</a>
                <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors">Jobs</a>
            </nav>

            <!-- Desktop Auth Controls -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-white text-slate-950 font-bold text-sm rounded-xl border border-slate-200/50 shadow-sm transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Console
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-400 hover:text-white transition-colors px-3 py-2">Log in</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-white text-slate-950 font-bold text-sm rounded-xl border border-slate-200/50 shadow-sm transition-all">Sign up</a>
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
    <div x-show="mobileMenuOpen" class="md:hidden fixed inset-0 z-35 flex bg-slate-950/85 backdrop-blur-sm" style="display: none;">
        <div class="w-64 bg-slate-900 border-r border-slate-800 h-full flex flex-col justify-between pt-24 pb-8 px-6 animate-slide-in">
            <nav class="space-y-2">
                <a @click="mobileMenuOpen = false" href="{{ route('marketplace.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Startups Marketplace
                </a>
                <a @click="mobileMenuOpen = false" href="{{ route('investors.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Investor Ecosystem
                </a>
                <a @click="mobileMenuOpen = false" href="{{ route('jobs.index') }}" class="flex items-center gap-3.5 px-4 py-3.5 text-sm font-semibold rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40">
                    Career Opportunities
                </a>
            </nav>

            <div class="border-t border-slate-800/60 pt-4 flex flex-col gap-2">
                @auth
                    <a @click="mobileMenuOpen = false" href="{{ url('/dashboard') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-750 text-white font-semibold text-sm rounded-xl border border-slate-700/40 transition-colors">Dashboard Console</a>
                @else
                    <a @click="mobileMenuOpen = false" href="{{ route('login') }}" class="w-full flex items-center justify-center py-2.5 text-sm font-semibold text-slate-400 hover:text-white transition-colors">Log in</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('register') }}" class="w-full flex items-center justify-center py-2.5 bg-slate-100 text-slate-950 font-bold text-sm rounded-xl transition-all">Sign up</a>
                @endauth
            </div>
        </div>
        <!-- Close overlay on tap -->
        <div class="flex-grow" @click="mobileMenuOpen = false"></div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow relative z-10">
        
        <!-- SECTION 1: HERO SECTION -->
        <section class="max-w-7xl mx-auto px-6 min-h-[calc(100vh-5rem)] flex flex-col justify-center relative">
            <!-- Ambient glows -->
            <div class="absolute top-[10%] left-[-5%] w-[40%] h-[40%] bg-slate-800/10 blur-[120px] rounded-full pointer-events-none"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[40%] h-[40%] bg-slate-700/10 blur-[120px] rounded-full pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row items-center gap-12 py-8 w-full">
                <!-- Left Info Column -->
                <div class="flex-1 text-center lg:text-left space-y-8">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/80 border border-slate-800 text-xs font-semibold text-slate-350">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-slate-550"></span>
                        </span>
                        Unified Builders' Portal
                    </div>
                    
                    <h1 class="font-heading text-5xl sm:text-6xl font-extrabold tracking-tight text-white leading-[1.1] max-w-xl">
                        Where <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">Startups</span><br />
                        Meet Growth.
                    </h1>
                    
                    <p class="text-slate-400 text-base sm:text-lg max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Connect with verified investors, hire high-velocity talent, and showcase products—all inside a single collaborative ecosystem.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-7 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-indigo-900/20 text-center flex items-center justify-center gap-2 text-sm border border-indigo-500">
                            Launch Your Startup
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <a href="#interactive-showcase" class="w-full sm:w-auto px-7 py-3.5 glass-panel border border-slate-850 text-slate-300 font-semibold rounded-xl hover:bg-slate-800/40 transition-colors duration-300 text-center text-sm">
                            Learn More
                        </a>
                    </div>
                </div>
                
                <!-- Right Illustration Column -->
                <div class="flex-1 relative w-full max-w-lg lg:max-w-none">
                    <!-- Dashboard Mockup Frame -->
                    <div class="relative z-10 rounded-2xl border border-slate-800 bg-slate-900/40 p-4 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center gap-1.5 border-b border-slate-800 pb-3 mb-4">
                            <span class="w-3 h-3 rounded-full bg-slate-700"></span>
                            <span class="w-3 h-3 rounded-full bg-slate-800"></span>
                            <span class="w-3 h-3 rounded-full bg-slate-800"></span>
                        </div>
                        <!-- Fixed duplicate image: Using an unsplash placeholder for the hero, or a generic hero.png if it exists -->
                        <img src="/images/hero.png" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop'" alt="Startup Platform Mockup" class="w-full h-auto rounded-xl border border-slate-800/80 object-cover aspect-[4/3] bg-slate-950" />
                    </div>
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 lg:-left-8 z-20 glass-panel p-4 rounded-xl flex items-center gap-3.5 shadow-2xl border border-slate-800/80 animate-float">
                        <div class="w-10 h-10 rounded-lg bg-slate-800 text-slate-350 border border-slate-750 flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-white">Seed Funding Secured</div>
                            <div class="text-[10px] text-slate-400 mt-0.5 font-medium">TechFlow Inc. just raised $2M</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: PLATFORM SHOWCASE (SCROLLING SECTIONS) -->
        <section id="interactive-showcase" class="py-24 border-t border-slate-900 bg-slate-900/20 relative">
            <div class="max-w-7xl mx-auto px-6 space-y-32">
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <span class="text-xs uppercase tracking-widest text-slate-500 font-bold">Platform Modules</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white">Explore Our Collaborative Pillars</h2>
                    <p class="text-slate-400 text-sm sm:text-base">Scroll down to discover the core functionality that powers the FoundrSearch ecosystem.</p>
                </div>

                <!-- 1. Startups -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6 order-2 lg:order-1">
                        <span class="px-3 py-1 bg-blue-900/30 border border-blue-800/50 rounded-full text-xs font-semibold text-blue-400">Catalog & Scale</span>
                        <h3 class="text-3xl font-heading font-extrabold text-white">Startup Showcase Marketplace</h3>
                        <p class="text-slate-400 leading-relaxed text-sm sm:text-base">
                            Build a comprehensive profile containing your seed funding stage, logo assets, company description, and category. Publish a detailed catalog of products and services to trade within our community.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Standardized Product & Service catalogs
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Admin Moderation verification queue
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Social, branding, and team overview setup
                            </li>
                        </ul>
                        <div class="pt-4">
                            <a href="{{ route('marketplace.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors">
                                Explore Startup Listings &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="relative rounded-2xl border border-slate-800 bg-slate-900/40 p-4 shadow-2xl backdrop-blur-xl order-1 lg:order-2">
                        <img src="/images/startups_showcase.png" alt="Startups Mockup" class="w-full h-auto rounded-xl border border-slate-850 object-cover aspect-[4/3]">
                    </div>
                </div>

                <!-- 2. Investors -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="relative rounded-2xl border border-slate-800 bg-slate-900/40 p-4 shadow-2xl backdrop-blur-xl">
                        <img src="/images/investor_dealflow.png" alt="Investors Mockup" class="w-full h-auto rounded-xl border border-slate-850 object-cover aspect-[4/3]">
                    </div>
                    <div class="space-y-6">
                        <span class="px-3 py-1 bg-emerald-900/30 border border-emerald-800/50 rounded-full text-xs font-semibold text-emerald-400">Vetted Capital</span>
                        <h3 class="text-3xl font-heading font-extrabold text-white">Venture Ecosystem & Dealflow</h3>
                        <p class="text-slate-400 leading-relaxed text-sm sm:text-base">
                            Unlock capital pipelines. Verified venture funds and angel networks gain immediate access to dealflow, upload pitch deck guidelines, review direct funding requests, and connect with founder teams.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Verified investor profile badges
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                PDF Pitch Deck submissions and review
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Direct capital requirement overview
                            </li>
                        </ul>
                        <div class="pt-4">
                            <a href="{{ route('investors.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-400 hover:text-emerald-300 transition-colors">
                                Search Active Investors &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. Jobs -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6 order-2 lg:order-1">
                        <span class="px-3 py-1 bg-violet-900/30 border border-violet-800/50 rounded-full text-xs font-semibold text-violet-400">Velocity Teams</span>
                        <h3 class="text-3xl font-heading font-extrabold text-white">Careers & Mentorship Portal</h3>
                        <p class="text-slate-400 leading-relaxed text-sm sm:text-base">
                            Accelerate your startup scale by posting open job positions. Freelancers and mentors search job boards, submit cover letters, attach PDF resumes, and track their applications from a private console.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-400">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Post and view active job openings
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Submit cover letters and upload resumes
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                Interactive hiring application tracker
                            </li>
                        </ul>
                        <div class="pt-4">
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-violet-400 hover:text-violet-300 transition-colors">
                                Browse Job Opportunities &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="relative rounded-2xl border border-slate-800 bg-slate-900/40 p-4 shadow-2xl backdrop-blur-xl order-1 lg:order-2">
                        <img src="/images/jobs_portal.png" alt="Jobs Mockup" class="w-full h-auto rounded-xl border border-slate-850 object-cover aspect-[4/3]">
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION 3: THE TIMELINE / ROADMAP -->
        <section class="py-24 bg-slate-900/10 border-t border-b border-slate-900">
            <div class="max-w-7xl mx-auto px-6 space-y-16">
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <span class="text-xs uppercase tracking-widest text-slate-500 font-bold">Process Workflow</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white">How The Ecosystem Works</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    <!-- Timeline lines on desktop -->
                    <div class="hidden md:block absolute top-6 left-12 right-12 h-px bg-slate-800 z-0"></div>

                    <!-- Step 1 -->
                    <div class="relative z-10 text-center space-y-4 group">
                        <div class="w-12 h-12 rounded-full bg-slate-900 border-2 border-slate-700 group-hover:border-slate-450 transition-all flex items-center justify-center font-bold text-slate-200 mx-auto">1</div>
                        <h4 class="font-heading font-bold text-white group-hover:text-slate-300 transition-colors">Create Account</h4>
                        <p class="text-xs text-slate-450 leading-relaxed px-4">Register as a founder, investor, or freelancer to activate your profile type.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative z-10 text-center space-y-4 group">
                        <div class="w-12 h-12 rounded-full bg-slate-900 border-2 border-slate-700 group-hover:border-slate-450 transition-all flex items-center justify-center font-bold text-slate-200 mx-auto">2</div>
                        <h4 class="font-heading font-bold text-white group-hover:text-slate-300 transition-colors">Upload Assets</h4>
                        <p class="text-xs text-slate-450 leading-relaxed px-4">Standardize catalogs, funding target thresholds, and target salary caps.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 text-center space-y-4 group">
                        <div class="w-12 h-12 rounded-full bg-slate-900 border-2 border-slate-700 group-hover:border-slate-450 transition-all flex items-center justify-center font-bold text-slate-200 mx-auto">3</div>
                        <h4 class="font-heading font-bold text-white group-hover:text-slate-300 transition-colors">Verification</h4>
                        <p class="text-xs text-slate-450 leading-relaxed px-4">Submissions flow into the moderation queue for vetting before public launch.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative z-10 text-center space-y-4 group">
                        <div class="w-12 h-12 rounded-full bg-slate-900 border-2 border-slate-700 group-hover:border-slate-450 transition-all flex items-center justify-center font-bold text-slate-200 mx-auto">4</div>
                        <h4 class="font-heading font-bold text-white group-hover:text-slate-300 transition-colors">Secure Capital</h4>
                        <p class="text-xs text-slate-450 leading-relaxed px-4">Connect with deals, submit hiring reviews, and communicate directly.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: CTA BANNER -->
        <section class="py-28 text-center max-w-5xl mx-auto px-6 space-y-8 relative">
            <div class="absolute top-[20%] left-[30%] w-[40%] h-[40%] bg-slate-800/10 blur-[100px] rounded-full pointer-events-none"></div>
            
            <h2 class="font-heading text-4xl sm:text-5xl font-extrabold text-white leading-tight">Ready to Scale Your Concept?</h2>
            <p class="text-slate-450 text-base max-w-xl mx-auto leading-relaxed">
                Gain immediate access to dealflow, hiring tools, and standardized profiles in one high-velocity, clean console environment.
            </p>
            <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-extrabold rounded-xl shadow-lg shadow-indigo-900/20 border border-indigo-500 transition-all text-sm">
                    Create Free Profile
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-slate-850 text-white font-semibold rounded-xl border border-slate-800 shadow-sm transition-colors text-sm">
                    Console Sign In
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-slate-900/60 text-center text-slate-550 text-xs relative z-10 bg-slate-950">
        &copy; {{ date('Y') }} FoundrSearch. All rights reserved.
    </footer>

</body>
</html>
