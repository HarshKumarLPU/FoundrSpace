<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 border-l-4 border-rose-500 pl-4">
            <div class="p-2 bg-rose-500/10 rounded-lg border border-rose-500/20 shadow-inner">
                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h2 class="font-black text-2xl text-slate-100 uppercase tracking-widest leading-tight">
                {{ __('Moderation Console') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-4 bg-emerald-950/40 border-l-4 border-emerald-500 text-emerald-200 rounded-r-xl flex items-center gap-3 shadow-[0_4px_15px_rgba(16,185,129,0.15)] animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold tracking-wide">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat Card: Users -->
            <div class="rounded-2xl p-6 border border-rose-900/40 bg-slate-900/60 shadow-sm flex items-center justify-between hover:border-rose-500/50 transition-colors duration-300 group">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-rose-400 transition-colors">Ecosystem Users</p>
                    <h3 class="text-3xl font-black text-white mt-1 group-hover:text-rose-50 transition-colors">{{ $stats['total_users'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>

            <!-- Stat Card: Startups -->
            <div class="rounded-2xl p-6 border border-rose-900/40 bg-slate-900/60 shadow-sm flex items-center justify-between hover:border-rose-500/50 transition-colors duration-300 group">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-rose-400 transition-colors">Total Startups</p>
                    <h3 class="text-3xl font-black text-white mt-1 group-hover:text-rose-50 transition-colors">{{ $stats['total_startups'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>

            <!-- Stat Card: Investors -->
            <div class="rounded-2xl p-6 border border-rose-900/40 bg-slate-900/60 shadow-sm flex items-center justify-between hover:border-rose-500/50 transition-colors duration-300 group">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-rose-400 transition-colors">Active Investors</p>
                    <h3 class="text-3xl font-black text-white mt-1 group-hover:text-rose-50 transition-colors">{{ $stats['total_investors'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <!-- Stat Card: Jobs -->
            <div class="rounded-2xl p-6 border border-rose-900/40 bg-slate-900/60 shadow-sm flex items-center justify-between hover:border-rose-500/50 transition-colors duration-300 group">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-rose-400 transition-colors">Career Postings</p>
                    <h3 class="text-3xl font-black text-white mt-1 group-hover:text-rose-50 transition-colors">{{ $stats['total_jobs'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Moderation Queue -->
        <div class="rounded-2xl border-2 border-rose-900/40 bg-slate-900 shadow-sm overflow-hidden shadow-[0_0_25px_rgba(225,29,72,0.05)] relative">
            <div class="absolute top-0 right-0 w-96 h-96 bg-rose-600/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
            
            <div class="p-6 border-b-2 border-rose-900/40 bg-rose-950/20 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
                <div>
                    <h3 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Startup Approvals Queue
                    </h3>
                    <p class="text-xs font-medium text-slate-400 mt-1">Approve or reject newly created startup profiles before they become public.</p>
                </div>
                <span class="px-4 py-1.5 text-xs font-black rounded-full bg-rose-500/20 text-rose-400 border border-rose-500/40 uppercase tracking-widest shadow-inner">
                    {{ $pendingStartups->count() }} Pending
                </span>
            </div>

            @if($pendingStartups->count() > 0)
                <div class="divide-y divide-rose-900/20 relative z-10">
                    @foreach($pendingStartups as $startup)
                        <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 hover:bg-slate-800/40 transition-colors border-l-4 border-transparent hover:border-rose-500">
                            <div class="flex items-center gap-5 flex-grow">
                                <div class="w-16 h-16 rounded-xl bg-slate-950 flex items-center justify-center border-2 border-slate-800 shadow-inner flex-shrink-0">
                                    @if($startup->logo)
                                        <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-black text-rose-500 text-2xl">{{ substr($startup->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-bold text-white text-xl">{{ $startup->name }}</h4>
                                        <span class="px-2.5 py-0.5 text-[9px] font-black rounded bg-slate-800 text-slate-300 border border-slate-700 uppercase tracking-widest">
                                            {{ $startup->stage }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-400 mt-1.5 line-clamp-2 max-w-2xl leading-relaxed">{{ $startup->description }}</p>
                                    <div class="flex flex-wrap items-center gap-4 text-[11px] font-bold text-slate-500 mt-3 uppercase tracking-wider">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Owner: <span class="text-rose-200">{{ $startup->user->name }}</span>
                                        </span>
                                        <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                            Category: <span class="text-rose-200">{{ $startup->category->name ?? 'Uncategorized' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3 w-full md:w-auto shrink-0 pt-4 md:pt-0">
                                <form action="{{ route('admin.startups.approve', $startup) }}" method="POST" class="flex-grow md:flex-grow-0">
                                    @csrf
                                    <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-black uppercase tracking-widest rounded-lg shadow-[0_0_15px_rgba(16,185,129,0.3)] transition-all hover:scale-105">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.startups.reject', $startup) }}" method="POST" class="flex-grow md:flex-grow-0">
                                    @csrf
                                    <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-rose-950 hover:bg-rose-900 text-rose-400 hover:text-rose-300 text-xs font-black uppercase tracking-widest rounded-lg border border-rose-900 hover:border-rose-500 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 relative z-10">
                    <div class="w-16 h-16 rounded-full bg-rose-900/20 flex items-center justify-center mx-auto mb-4 border border-rose-500/20 shadow-inner">
                        <svg class="h-8 w-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-black text-white tracking-tight">Queue Empty</h4>
                    <p class="text-sm font-medium text-slate-400 mt-2">There are no pending startups awaiting moderation right now.</p>
                </div>
            @endif
        </div>

        <!-- Approved Startups -->
        <div class="rounded-2xl border-2 border-cyan-900/40 bg-slate-900 shadow-sm overflow-hidden shadow-[0_0_25px_rgba(6,182,212,0.05)] relative mt-8">
            <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-600/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
            
            <div class="p-6 border-b-2 border-cyan-900/40 bg-cyan-950/20 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
                <div>
                    <h3 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Approved Startups
                    </h3>
                    <p class="text-xs font-medium text-slate-400 mt-1">Manage verified status for active startups on the platform.</p>
                </div>
                <span class="px-4 py-1.5 text-xs font-black rounded-full bg-cyan-500/20 text-cyan-400 border border-cyan-500/40 uppercase tracking-widest shadow-inner">
                    {{ $approvedStartups->count() }} Active
                </span>
            </div>

            @if($approvedStartups->count() > 0)
                <div class="divide-y divide-cyan-900/20 relative z-10">
                    @foreach($approvedStartups as $startup)
                        <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-8 hover:bg-slate-800/40 transition-colors border-l-4 border-transparent hover:border-cyan-500">
                            <div class="flex items-center gap-5 flex-grow">
                                <div class="w-16 h-16 rounded-xl bg-slate-950 flex items-center justify-center border-2 border-slate-800 shadow-inner flex-shrink-0 relative">
                                    @if($startup->logo)
                                        <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-black text-cyan-500 text-2xl">{{ substr($startup->name, 0, 1) }}</span>
                                    @endif
                                    @if($startup->is_verified)
                                        <div class="absolute -top-2 -right-2 bg-slate-900 rounded-full border border-slate-800">
                                            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-bold text-white text-xl">{{ $startup->name }}</h4>
                                        <span class="px-2.5 py-0.5 text-[9px] font-black rounded bg-slate-800 text-slate-300 border border-slate-700 uppercase tracking-widest">
                                            {{ $startup->stage }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-400 mt-1.5 line-clamp-2 max-w-2xl leading-relaxed">{{ $startup->description }}</p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center gap-3 w-full md:w-auto shrink-0 pt-4 md:pt-0">
                                <form action="{{ route('admin.startups.verify', $startup) }}" method="POST" class="flex-grow md:flex-grow-0">
                                    @csrf
                                    <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 {{ $startup->is_verified ? 'bg-slate-800 text-slate-400 hover:text-white border border-slate-700 hover:border-rose-500' : 'bg-blue-600 hover:bg-blue-500 text-white shadow-[0_0_15px_rgba(59,130,246,0.3)]' }} text-xs font-black uppercase tracking-widest rounded-lg transition-all hover:scale-105">
                                        @if($startup->is_verified)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Revoke Badge
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Verify Startup
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 relative z-10">
                    <p class="text-sm font-medium text-slate-400">No approved startups found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
