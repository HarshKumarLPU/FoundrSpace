<x-public-layout>
    <!-- Premium Investor Header -->
    <div class="relative bg-slate-950 pt-20 pb-24 overflow-hidden border-b border-slate-900 shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/20 via-slate-900/80 to-teal-900/10 pointer-events-none z-0"></div>
        <div class="absolute top-0 left-0 w-[40rem] h-[40rem] bg-emerald-500/10 rounded-full blur-3xl -ml-20 -mt-20 pointer-events-none z-0"></div>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="{{ route('investors.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-white transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                Back to Investor Ecosystem
            </a>

            <div class="flex flex-col md:flex-row items-start md:items-center gap-8">
                <!-- Investor Avatar/Logo -->
                <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full bg-gradient-to-br from-emerald-900 to-slate-900 border-4 border-emerald-500/30 overflow-hidden shadow-[0_0_30px_rgba(16,185,129,0.2)] flex items-center justify-center shrink-0 relative group">
                    <div class="absolute inset-0 bg-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <span class="font-black text-emerald-400 text-6xl relative z-10">
                        {{ substr($investor->organization ?? $investor->user->name, 0, 1) }}
                    </span>
                </div>
                
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        @if($investor->is_verified)
                            <span class="px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-black text-[10px] uppercase tracking-widest shadow-inner flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.585a.75.75 0 011.05-.12l2.25 1.875a.75.75 0 010 1.15l-2.25 1.875a.75.75 0 11-.96-1.15l1.56-1.3-1.56-1.3a.75.75 0 01-.12-1.05z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified Partner
                            </span>
                        @endif
                        <span class="text-sm font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            {{ $investor->investment_range ?? 'Seed / Early Stage' }}
                        </span>
                    </div>
                    <h1 class="font-heading text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">{{ $investor->organization ?? 'Independent Investor' }}</h1>
                    <p class="text-xl text-emerald-100/70 font-medium">Managed by {{ $investor->user->name }}</p>
                </div>
                
                <div class="w-full md:w-auto shrink-0 mt-6 md:mt-0">
                    <a href="mailto:{{ $investor->user->email }}" class="w-full sm:w-auto px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl shadow-[0_4px_20px_rgba(16,185,129,0.3)] hover:shadow-[0_6px_30px_rgba(16,185,129,0.4)] transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                        Pitch to Investor
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-10 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Investment Philosophy -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-slate-900 rounded-[2rem] p-8 md:p-10 border border-slate-800 shadow-xl relative overflow-hidden group hover:border-emerald-500/30 transition-colors duration-500">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none transition-opacity duration-500 opacity-50 group-hover:opacity-100"></div>
                    <h2 class="text-2xl font-black text-white mb-6 tracking-tight flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Investment Philosophy
                    </h2>
                    <div class="prose prose-invert max-w-none">
                        <p class="text-slate-300 leading-relaxed text-lg whitespace-pre-line font-medium border-l-4 border-emerald-500/30 pl-5">
                            {{ $investor->bio ?? 'This investor has not detailed their investment philosophy yet.' }}
                        </p>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-xl">
                    <h2 class="text-2xl font-black text-white mb-6 tracking-tight flex items-center gap-3">
                        <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Past Investments (Mock Data)
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($pastInvestments as $inv)
                            <div class="p-6 rounded-2xl bg-slate-950 border border-slate-800 hover:border-teal-500/30 transition-colors group">
                                <h4 class="text-white font-bold text-lg group-hover:text-teal-400 transition-colors">{{ $inv->name }}</h4>
                                <div class="flex justify-between items-center mt-4 text-sm font-semibold">
                                    <span class="text-slate-500">{{ $inv->round }} Round</span>
                                    <span class="text-emerald-400">{{ $inv->amount }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Focus Areas & Contact -->
            <div class="space-y-8">
                
                <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-900/10 to-transparent pointer-events-none"></div>
                    <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest mb-6 relative z-10">Investment Parameters</h3>
                    
                    <ul class="space-y-6 relative z-10">
                        <li>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Check Size</p>
                            <p class="text-white font-bold text-lg flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $investor->investment_range ?? '$50k - $250k' }}
                            </p>
                        </li>
                        <li>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Preferred Stage</p>
                            <p class="text-white font-bold text-lg flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                Pre-Seed / Seed
                            </p>
                        </li>
                        <li>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Geo Focus</p>
                            <p class="text-white font-bold text-lg flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Global / Remote
                            </p>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-xl text-center">
                    <div class="w-16 h-16 bg-slate-950 rounded-full flex items-center justify-center text-slate-400 mx-auto mb-4 border border-slate-800 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-2">Direct Contact</h3>
                    <p class="text-sm text-slate-400 mb-6">Reach out to the general partner to discuss alignment and share your deck.</p>
                    <a href="mailto:{{ $investor->user->email }}" class="inline-block px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl transition-colors border border-slate-700 w-full">
                        {{ $investor->user->email }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-public-layout>
