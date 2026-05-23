<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-500/10 rounded-lg border border-indigo-500/20">
                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-100 leading-tight">
                {{ __('Startup Owner Console') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-4 bg-indigo-950/50 border border-indigo-500/30 text-indigo-200 rounded-xl flex items-center gap-3 shadow-[0_0_20px_rgba(99,102,241,0.15)] animate-fade-in-down">
                <svg class="w-5 h-5 flex-shrink-0 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if($startup)
            <!-- Profile Cover & Summary -->
            <div class="glass-panel rounded-2xl border border-indigo-900/50 shadow-[0_4px_20px_rgba(79,70,229,0.05)] overflow-hidden group hover:border-indigo-500/30 transition-all duration-500">
                @if($startup->banner)
                    <div class="h-32 bg-slate-900 relative overflow-hidden">
                        <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                    </div>
                @else
                    <div class="h-32 bg-gradient-to-r from-indigo-950 via-slate-900 to-cyan-950 relative overflow-hidden">
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>
                    </div>
                @endif
                <div class="px-8 pb-8 relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-slate-900/60 backdrop-blur-md">
                    <div class="flex items-start gap-5 -mt-10 relative z-10">
                        <div class="w-24 h-24 rounded-2xl bg-slate-950 border-4 border-slate-900 overflow-hidden flex items-center justify-center shadow-xl group-hover:shadow-indigo-500/20 transition-all duration-300 group-hover:-translate-y-1">
                            @if($startup->logo)
                                <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                            @else
                                <span class="font-black text-indigo-500 text-4xl">{{ substr($startup->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="mt-12 md:mt-11">
                            <div class="flex items-center gap-3">
                                <h3 class="text-3xl font-extrabold text-white tracking-tight">{{ $startup->name }}</h3>
                                <span class="px-3 py-1 text-xs font-bold rounded-md bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-widest shadow-inner">
                                    {{ $startup->stage }}
                                </span>
                            </div>
                            <p class="text-sm font-medium text-slate-400 mt-1.5 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                {{ $startup->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>
                    </div>
                    <div class="md:mt-8 flex items-center gap-3 w-full md:w-auto relative z-10">
                        <a href="{{ route('startups.edit', $startup) }}" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold rounded-xl border border-slate-700 transition-all duration-300 hover:-translate-y-0.5 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Profile
                        </a>
                        <a href="{{ route('jobs.create') }}" class="w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-xl shadow-[0_0_15px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Post a Job
                        </a>
                    </div>
                </div>
            </div>

            <!-- Analytics Chart -->
            <div class="glass-panel rounded-2xl p-6 border border-indigo-900/30 bg-slate-900/40 shadow-[0_4px_20px_rgba(79,70,229,0.05)] mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Profile Views & Engagement
                    </h3>
                    <select class="bg-slate-950 border border-slate-800 text-slate-300 text-xs rounded-lg px-3 py-1.5 outline-none focus:border-indigo-500">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                    </select>
                </div>
                <div class="flex gap-8 mb-6 border-b border-indigo-900/30 pb-6">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Views</p>
                        <h4 class="text-3xl font-black text-white mt-1">{{ $startup->views_count }}</h4>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Investor Bookmarks</p>
                        <h4 class="text-3xl font-black text-white mt-1">{{ $startup->bookmarks()->count() }}</h4>
                    </div>
                </div>
                <div class="h-64 w-full relative">
                    <canvas id="startupAnalyticsChart"></canvas>
                </div>
            </div>

            <!-- Stats Overview Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="glass-panel rounded-2xl p-6 border border-indigo-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.02] hover:border-indigo-500/30 transition-transform duration-300 cursor-default group">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Market Products</p>
                    <h4 class="text-4xl font-black text-white mt-2 group-hover:text-indigo-50 transition-colors">{{ $products->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-cyan-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.02] hover:border-cyan-500/30 transition-transform duration-300 cursor-default group">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest group-hover:text-cyan-400 transition-colors">Services Listed</p>
                    <h4 class="text-4xl font-black text-white mt-2 group-hover:text-cyan-50 transition-colors">{{ $services->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-indigo-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.02] hover:border-indigo-500/30 transition-transform duration-300 cursor-default group">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest group-hover:text-indigo-400 transition-colors">Open Positions</p>
                    <h4 class="text-4xl font-black text-white mt-2 group-hover:text-indigo-50 transition-colors">{{ $jobPostings->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-cyan-900/30 bg-slate-900/40 shadow-sm text-center hover:scale-[1.02] hover:border-cyan-500/30 transition-transform duration-300 cursor-default group">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest group-hover:text-cyan-400 transition-colors">Job Applications</p>
                    <h4 class="text-4xl font-black text-white mt-2 group-hover:text-cyan-50 transition-colors">{{ $applications->count() }}</h4>
                </div>
            </div>

            <!-- Main Details Split Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Columns: Products, Services, Jobs -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Products List -->
                    <div class="glass-panel rounded-2xl border border-indigo-900/30 bg-slate-900/40 shadow-sm overflow-hidden hover:border-indigo-500/20 transition-colors duration-300">
                        <div class="p-5 border-b border-indigo-900/30 flex justify-between items-center bg-indigo-950/10">
                            <h3 class="font-extrabold text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Products Catalog
                            </h3>
                        </div>
                        @if($products->count() > 0)
                            <div class="divide-y divide-slate-800/60">
                                @foreach($products as $product)
                                    <div class="p-5 flex justify-between items-center hover:bg-slate-800/30 transition-colors">
                                        <div>
                                            <h4 class="font-bold text-slate-200">{{ $product->title }}</h4>
                                            <p class="text-[11px] font-medium text-indigo-400/80 uppercase mt-1 tracking-widest">{{ $product->type }}</p>
                                        </div>
                                        <span class="text-lg font-black text-indigo-300">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-10 text-center">
                                <div class="w-12 h-12 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <p class="text-sm text-slate-500 font-medium">No products listed in the marketplace yet.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Job Postings List -->
                    <div class="glass-panel rounded-2xl border border-indigo-900/30 bg-slate-900/40 shadow-sm overflow-hidden hover:border-indigo-500/20 transition-colors duration-300">
                        <div class="p-5 border-b border-indigo-900/30 flex justify-between items-center bg-indigo-950/10">
                            <h3 class="font-extrabold text-white flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Active Positions
                            </h3>
                        </div>
                        @if($jobPostings->count() > 0)
                            <div class="divide-y divide-slate-800/60">
                                @foreach($jobPostings as $job)
                                    <div class="p-5 flex justify-between items-center hover:bg-slate-800/30 transition-colors">
                                        <div>
                                            <h4 class="font-bold text-slate-200">{{ $job->title }}</h4>
                                            <p class="text-xs font-medium text-slate-400 mt-1 flex items-center gap-2">
                                                <span>{{ $job->salary_range ?? 'Unspecified' }}</span>
                                                <span class="w-1 h-1 rounded-full bg-slate-600"></span>
                                                <span class="text-indigo-300">{{ ucfirst($job->type) }}</span>
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-[10px] font-black rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-widest shadow-inner">
                                            {{ $job->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-10 text-center">
                                <div class="w-12 h-12 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-sm text-slate-500 font-medium">No active positions posted.</p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Right Column: Candidate Applications Tracking -->
                <div class="space-y-8">
                    <div class="glass-panel rounded-2xl border border-indigo-900/40 bg-slate-900/60 shadow-sm overflow-hidden hover:border-indigo-500/30 transition-all duration-300">
                        <div class="p-6 border-b border-indigo-900/40 bg-indigo-950/20 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
                            <h3 class="font-extrabold text-white flex items-center gap-2 relative z-10">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Hiring Pipeline
                            </h3>
                            <p class="text-[11px] font-medium text-slate-400 mt-1.5 leading-relaxed relative z-10">Review candidates who applied to your startup openings.</p>
                        </div>
                        @if($applications->count() > 0)
                            <div class="divide-y divide-slate-800/60">
                                @foreach($applications as $app)
                                    <div class="p-6 space-y-4 hover:bg-slate-800/40 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-slate-100">{{ $app->user->name }}</h4>
                                                <p class="text-[11px] font-bold text-indigo-400 uppercase tracking-wider mt-1">{{ $app->jobPosting->title }}</p>
                                            </div>
                                            <span class="px-2.5 py-1 text-[9px] font-black rounded-md {{ $app->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : ($app->status === 'accepted' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700') }} uppercase shadow-sm tracking-widest">
                                                {{ $app->status }}
                                            </span>
                                        </div>
                                        
                                        <div class="text-xs text-slate-400 leading-relaxed bg-slate-950/30 p-3 rounded-lg border border-slate-800/50">
                                            {{ $app->cover_letter ?? 'No cover letter provided.' }}
                                        </div>

                                        <div class="flex items-center justify-between pt-2">
                                            <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="text-[11px] font-bold text-slate-300 hover:text-indigo-300 inline-flex items-center gap-1.5 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                View Resume
                                            </a>
                                            
                                            <div class="flex items-center gap-2">
                                                @if($app->status === 'pending')
                                                    <form action="{{ route('applications.accept', $app) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-lg border border-emerald-500/20 hover:border-emerald-500 transition-all shadow-sm" title="Accept Candidate">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('applications.reject', $app) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white rounded-lg border border-red-500/20 hover:border-red-500 transition-all shadow-sm" title="Reject Candidate">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest">{{ $app->created_at->diffForHumans() }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-10 text-center">
                                <div class="w-12 h-12 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <p class="text-sm text-slate-500 font-medium">No job applications received yet.</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Investment Proposals Tracking -->
                    <div class="glass-panel rounded-2xl border border-emerald-900/40 bg-slate-900/60 shadow-sm overflow-hidden hover:border-emerald-500/30 transition-all duration-300">
                        <div class="p-6 border-b border-emerald-900/40 bg-emerald-950/20 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
                            <h3 class="font-extrabold text-white flex items-center gap-2 relative z-10">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Investment Proposals
                            </h3>
                            <p class="text-[11px] font-medium text-slate-400 mt-1.5 leading-relaxed relative z-10">Review and manage inbound investment offers from verified investors.</p>
                        </div>
                        @if($investmentProposals->count() > 0)
                            <div class="divide-y divide-slate-800/60">
                                @foreach($investmentProposals as $proposal)
                                    <div class="p-6 space-y-4 hover:bg-slate-800/40 transition-colors">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-slate-100">{{ $proposal->investor->user->name }}</h4>
                                                <p class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider mt-1">{{ $proposal->investor->organization ?? 'Independent Investor' }}</p>
                                            </div>
                                            <span class="px-2.5 py-1 text-[9px] font-black rounded-md {{ $proposal->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : ($proposal->status === 'accepted' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700') }} uppercase shadow-sm tracking-widest">
                                                {{ $proposal->status }}
                                            </span>
                                        </div>
                                        
                                        <div class="text-sm font-black text-white bg-slate-950/50 px-3 py-2 rounded border border-slate-800">
                                            Offer: <span class="text-emerald-400">{{ $proposal->proposed_amount }}</span>
                                        </div>
                                        
                                        <div class="text-xs text-slate-400 leading-relaxed bg-slate-950/30 p-3 rounded-lg border border-slate-800/50">
                                            {{ $proposal->message }}
                                        </div>

                                        <div class="flex items-center justify-between pt-2">
                                            <a href="{{ route('investors.show', $proposal->investor) }}" class="text-[11px] font-bold text-slate-300 hover:text-emerald-300 inline-flex items-center gap-1.5 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                                View Investor Profile
                                            </a>
                                            
                                            <div class="flex items-center gap-2">
                                                @if($proposal->status === 'pending')
                                                    <form action="{{ route('investment-proposals.accept', $proposal) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-lg border border-emerald-500/20 hover:border-emerald-500 transition-all shadow-sm" title="Accept Proposal">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('investment-proposals.reject', $proposal) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white rounded-lg border border-red-500/20 hover:border-red-500 transition-all shadow-sm" title="Reject Proposal">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest">{{ $proposal->updated_at->diffForHumans() }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-10 text-center">
                                <div class="w-12 h-12 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-sm text-slate-500 font-medium">No investment proposals received yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Missing Startup Profile Warning -->
            <div class="p-10 bg-indigo-950/20 rounded-2xl border border-indigo-900/50 text-center space-y-5 max-w-xl mx-auto shadow-[0_0_30px_rgba(79,70,229,0.1)] relative overflow-hidden">
                <div class="absolute inset-0 bg-grid opacity-30 pointer-events-none"></div>
                <div class="w-20 h-20 rounded-2xl bg-indigo-900/40 text-indigo-400 flex items-center justify-center mx-auto border border-indigo-500/20 shadow-inner relative z-10 animate-bounce-slow">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-white relative z-10 tracking-tight">Create your Startup Profile</h3>
                <p class="text-slate-400 text-sm leading-relaxed relative z-10 font-medium">You must set up your company details to enable product listing, jobs posting, and connecting with the investor ecosystem.</p>
                <div class="pt-4 relative z-10">
                    <a href="{{ route('startups.create') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl hover:scale-105 transition-all text-sm shadow-[0_0_20px_rgba(79,70,229,0.4)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Build Startup Profile
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Chart Initialization -->
    @if($startup)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('startupAnalyticsChart').getContext('2d');
            
            // Create gradient
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.5)'); // Indigo 500
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Profile Views',
                        data: [120, 190, 150, 220, 180, 250, 210],
                        borderColor: '#6366f1', // Indigo 500
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointBackgroundColor: '#312e81', // Indigo 900
                        pointBorderColor: '#818cf8', // Indigo 400
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', // Slate 900
                            titleColor: '#f1f5f9',
                            bodyColor: '#cbd5e1',
                            borderColor: '#334155',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) { return context.parsed.y + ' Views'; }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.05)', drawBorder: false },
                            ticks: { color: '#64748b', font: { size: 10 } }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#64748b', font: { size: 11 } }
                        }
                    },
                    interaction: { mode: 'index', intersect: false }
                }
            });
        });
    </script>
    @endif
</x-app-layout>
