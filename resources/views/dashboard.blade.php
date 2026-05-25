<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-amber-500/10 rounded-xl border border-amber-500/20 shadow-inner">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
            </div>
            <h2 class="font-black text-2xl text-slate-100 tracking-tight">
                {{ __('Welcome to FoundrSearch') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Hero Banner -->
        <div
            class="relative overflow-hidden p-10 rounded-[2rem] border border-amber-900/40 bg-slate-900 shadow-[0_8px_30px_rgba(245,158,11,0.05)] flex flex-col md:flex-row justify-between items-center gap-8 group hover:border-amber-500/30 transition-all duration-500">
            <div
                class="absolute inset-0 bg-gradient-to-br from-amber-900/10 via-slate-900 to-orange-900/10 pointer-events-none">
            </div>
            <div
                class="absolute -top-32 -right-32 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700">
            </div>

            <div class="relative z-10 max-w-2xl text-center md:text-left">
                <h3 class="text-4xl font-black text-white tracking-tight leading-tight">Discover the Next Big Thing.
                </h3>
                <p
                    class="text-sm font-bold text-amber-400 uppercase tracking-widest mt-3 flex items-center justify-center md:justify-start gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    Customer / Early Adopter
                </p>
                <p class="text-slate-400 mt-5 text-base leading-relaxed font-medium">Explore groundbreaking products,
                    back visionary founders, and engage with the emerging startup ecosystem directly through our
                    marketplace.</p>

                <div class="mt-8">
                    <a href="{{ route('marketplace.index') }}"
                        class="inline-flex justify-center items-center gap-3 px-8 py-4 bg-amber-500 hover:bg-amber-400 text-slate-950 font-black text-sm rounded-xl shadow-[0_4px_20px_rgba(245,158,11,0.3)] hover:shadow-[0_8px_30px_rgba(245,158,11,0.5)] transition-all duration-300 hover:scale-[1.03] active:scale-95 uppercase tracking-wide">
                        Explore Marketplace
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="relative z-10 hidden md:block shrink-0">
                <div class="w-64 h-64 relative">
                    <div class="absolute inset-0 bg-amber-500/20 rounded-full blur-2xl animate-pulse"></div>
                    <div
                        class="w-full h-full bg-slate-800 rounded-3xl border border-amber-500/30 shadow-2xl flex items-center justify-center transform rotate-6 group-hover:rotate-12 transition-transform duration-700">
                        <svg class="w-24 h-24 text-amber-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>