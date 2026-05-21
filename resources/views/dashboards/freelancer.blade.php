<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-violet-500/10 rounded-xl border border-violet-500/20 shadow-inner">
                <svg class="w-6 h-6 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            </div>
            <h2 class="font-black text-2xl text-transparent bg-clip-text bg-gradient-to-r from-violet-300 to-fuchsia-300 leading-tight">
                {{ __('Freelancer & Mentor Console') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-4 bg-violet-950/40 border-l-4 border-violet-500 text-violet-200 rounded-r-xl flex items-center gap-3 shadow-[0_4px_15px_rgba(139,92,246,0.15)] animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Banner / Profile -->
        <div class="relative overflow-hidden p-10 rounded-[2rem] border border-violet-900/40 bg-slate-900 shadow-[0_8px_30px_rgba(139,92,246,0.08)] flex flex-col md:flex-row justify-between items-start md:items-center gap-6 group hover:border-violet-500/30 transition-colors duration-500">
            <div class="absolute inset-0 bg-gradient-to-br from-violet-900/20 via-transparent to-fuchsia-900/10 pointer-events-none"></div>
            <div class="absolute -top-32 -left-32 w-64 h-64 bg-violet-600/10 rounded-full blur-3xl group-hover:bg-violet-500/20 transition-all duration-700"></div>

            <div class="relative z-10 max-w-2xl">
                <h3 class="text-3xl font-black text-white tracking-tight">Welcome back, <span class="text-violet-400">{{ auth()->user()->name }}</span>!</h3>
                <p class="text-xs font-bold text-violet-300 uppercase tracking-widest mt-2 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-violet-500 animate-pulse"></span>
                    Ecosystem Role: Freelancer / Mentor
                </p>
                <p class="text-slate-400 mt-4 text-sm leading-relaxed font-medium">Find project opportunities, full-time roles, and mentor requests from emerging startups looking for your unique expertise.</p>
            </div>
            
            <div class="relative z-10 w-full md:w-auto shrink-0 pt-4 md:pt-0">
                <a href="{{ route('jobs.index') }}" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-8 py-4 bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-500 hover:to-fuchsia-500 text-white font-black text-sm rounded-xl shadow-[0_4px_20px_rgba(139,92,246,0.4)] hover:shadow-[0_8px_30px_rgba(139,92,246,0.6)] transition-all duration-300 hover:scale-[1.03] active:scale-95">
                    Browse Job Board
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Application Pipeline Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="rounded-3xl p-6 border border-violet-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.03] hover:bg-slate-900/60 hover:border-violet-500/40 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-violet-500/10 text-violet-400 mx-auto flex items-center justify-center mb-3 group-hover:-translate-y-1 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-violet-300 transition-colors">Total Applications</p>
                <h4 class="text-4xl font-black text-white mt-1 group-hover:text-violet-50">{{ $applications->count() }}</h4>
            </div>
            
            <div class="rounded-3xl p-6 border border-fuchsia-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.03] hover:bg-slate-900/60 hover:border-fuchsia-500/40 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-fuchsia-500/10 text-fuchsia-400 mx-auto flex items-center justify-center mb-3 group-hover:-translate-y-1 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-fuchsia-300 transition-colors">Pending Review</p>
                <h4 class="text-4xl font-black text-white mt-1 group-hover:text-fuchsia-50">{{ $applications->where('status', 'pending')->count() }}</h4>
            </div>
            
            <div class="rounded-3xl p-6 border border-violet-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.03] hover:bg-slate-900/60 hover:border-violet-500/40 transition-all duration-300 group">
                <div class="w-10 h-10 rounded-xl bg-violet-500/10 text-violet-400 mx-auto flex items-center justify-center mb-3 group-hover:-translate-y-1 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-violet-300 transition-colors">Interviews & Offered</p>
                <h4 class="text-4xl font-black text-white mt-1 group-hover:text-violet-50">{{ $applications->whereIn('status', ['interview', 'accepted'])->count() }}</h4>
            </div>
        </div>

        <!-- Applications Tracking List -->
        <div class="rounded-[2rem] border border-violet-900/30 bg-slate-900/30 shadow-[0_4px_25px_rgba(139,92,246,0.05)] overflow-hidden">
            <div class="p-8 border-b border-violet-900/30 bg-violet-950/10 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-fuchsia-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
                <h3 class="font-black text-2xl text-white tracking-tight relative z-10 flex items-center gap-3">
                    <svg class="w-6 h-6 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Your Submitted Applications
                </h3>
                <p class="text-sm font-medium text-slate-400 mt-2 relative z-10">Track the status of your applications to startup job roles.</p>
            </div>

            @if($applications->count() > 0)
                <div class="divide-y divide-violet-900/20 p-4">
                    @foreach($applications as $app)
                        <div class="p-6 rounded-2xl hover:bg-slate-800/40 hover:scale-[1.01] transition-all duration-300 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 group cursor-pointer border border-transparent hover:border-violet-900/50">
                            <div class="flex-grow">
                                <div class="flex items-center gap-3">
                                    <h4 class="font-bold text-white text-xl">{{ $app->jobPosting->title }}</h4>
                                    <span class="px-3 py-1 text-[10px] font-black rounded-lg bg-violet-500/10 text-violet-300 border border-violet-500/20 uppercase tracking-widest shadow-inner group-hover:bg-violet-500 group-hover:text-white transition-colors duration-300">
                                        {{ $app->jobPosting->startup->name }}
                                    </span>
                                </div>
                                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mt-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Applied {{ $app->created_at->diffForHumans() }}
                                </p>
                                
                                @if($app->cover_letter)
                                    <div class="mt-4 p-4 bg-slate-950/40 rounded-xl border border-slate-800/60 text-sm text-slate-400 max-w-3xl leading-relaxed">
                                        <strong class="text-[10px] uppercase tracking-widest text-violet-400 block mb-2">Cover Letter Snippet</strong>
                                        {{ Str::limit($app->cover_letter, 150) }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto shrink-0 pt-2 md:pt-0">
                                <span class="w-full sm:w-auto px-4 py-2 text-[10px] font-black rounded-full {{ $app->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : ($app->status === 'accepted' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700') }} uppercase tracking-widest text-center shadow-sm">
                                    Status: {{ $app->status }}
                                </span>
                                <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-5 py-2 rounded-full bg-violet-900/30 hover:bg-violet-600 text-violet-300 hover:text-white text-xs font-bold transition-colors border border-violet-900/50 hover:border-violet-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    Resume
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 px-6">
                    <div class="w-20 h-20 rounded-full bg-violet-900/20 flex items-center justify-center mx-auto mb-6 border border-violet-500/20 shadow-inner">
                        <svg class="h-10 w-10 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-black text-white tracking-tight">No applications yet</h4>
                    <p class="text-sm font-medium text-slate-400 mt-2 mb-8 max-w-sm mx-auto">Browse open positions posted by startups and submit your first application to kickstart your journey.</p>
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-violet-600 hover:bg-violet-500 text-white text-sm font-bold rounded-xl transition-all shadow-[0_4px_15px_rgba(139,92,246,0.3)] hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(139,92,246,0.5)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Explore Job Board
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
