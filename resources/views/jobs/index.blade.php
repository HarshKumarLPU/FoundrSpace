<x-public-layout>
    <!-- Hero Section -->
    <div class="relative bg-slate-950 overflow-hidden border-b border-slate-900 pb-16 pt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-violet-900/20 via-slate-900 to-fuchsia-900/10 pointer-events-none"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-fuchsia-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-500/10 text-violet-400 text-xs font-bold uppercase tracking-widest border border-violet-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-violet-500 animate-pulse"></span>
                Freelancers & Talent
            </span>
            <h1 class="font-heading text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">
                Career <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-400 to-fuchsia-400">Opportunities</span>
            </h1>
            <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                Join a high-growth startup and build the future. Discover full-time roles, contract gigs, and mentorship opportunities with the fastest growing companies in the ecosystem.
            </p>

            <!-- Mock Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Open Roles</p>
                    <p class="text-2xl font-black text-white">{{ $jobs->total() }}</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Remote Positions</p>
                    <p class="text-2xl font-black text-violet-400">85%</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Avg Salary</p>
                    <p class="text-2xl font-black text-fuchsia-400">$120k</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Startups Hiring</p>
                    <p class="text-2xl font-black text-white">400+</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 800)">
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Top Filters -->
        <div class="mb-10">
            <form action="{{ route('jobs.index') }}" method="GET" class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                <div class="flex flex-col lg:flex-row items-start lg:items-end gap-6">
                    
                    <div class="flex items-center gap-3 lg:w-48 flex-shrink-0">
                        <div class="w-10 h-10 rounded-xl bg-violet-500/10 text-violet-400 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-white leading-tight">Find Role</h3>
                            <p class="text-xs text-slate-500 font-medium">Search jobs</p>
                        </div>
                    </div>

                    <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-6 w-full items-end">
                        <!-- Keyword Search -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Job Title / Keyword</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. Full Stack..." class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-violet-500 focus:border-violet-500 p-3 outline-none transition-colors">
                        </div>
                        
                        <!-- Job Type Filter -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Job Type</label>
                            <select name="type" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-violet-500 focus:border-violet-500 p-3 outline-none transition-colors appearance-none">
                                <option value="">Any Type</option>
                                <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-Time</option>
                                <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract / Freelance</option>
                                <option value="Internship" {{ request('type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Co-founder" {{ request('type') == 'Co-founder' ? 'selected' : '' }}>Co-founder / Equity</option>
                            </select>
                        </div>
                        
                        <!-- Salary Filter -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Salary / Rate</label>
                            <select name="salary" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-violet-500 focus:border-violet-500 p-3 outline-none transition-colors appearance-none">
                                <option value="">Any Compensation</option>
                                <option value="equity">Equity Only</option>
                                <option value="50k">$50k - $100k</option>
                                <option value="100k">$100k - $150k</option>
                                <option value="150k+">$150k+</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="w-full md:col-span-1">
                            <button type="submit" class="w-full py-3 bg-violet-600 hover:bg-violet-500 text-white text-sm font-bold rounded-xl shadow-[0_4px_15px_rgba(139,92,246,0.2)] hover:shadow-[0_6px_20px_rgba(139,92,246,0.4)] transition-all active:scale-95 h-[46px] flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Search Jobs
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Jobs List -->
        <div class="w-full space-y-4">
            <template x-if="loading">
                    <div class="space-y-4">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="block group relative bg-slate-900 rounded-3xl p-6 border border-slate-800 overflow-hidden shadow-lg animate-pulse">
                                <div class="flex flex-col sm:flex-row gap-8 items-start sm:items-center">
                                    <div class="w-20 h-20 rounded-2xl bg-slate-800 border-2 border-slate-700 flex-shrink-0"></div>
                                    <div class="flex-grow w-full">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-3">
                                            <div>
                                                <div class="h-6 w-48 bg-slate-800 rounded mb-2"></div>
                                                <div class="h-4 w-32 bg-slate-800 rounded"></div>
                                            </div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <div class="h-6 w-20 bg-slate-800 rounded-full"></div>
                                                <div class="h-6 w-20 bg-slate-800 rounded-full"></div>
                                            </div>
                                        </div>
                                        <div class="h-8 w-64 bg-slate-800 rounded-xl mt-4"></div>
                                    </div>
                                    <div class="hidden md:flex items-center justify-center p-3 rounded-xl bg-slate-800 w-11 h-11"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </template>
                <div x-show="!loading" style="display: none;" class="space-y-4">
                @if($jobs->count() > 0)
                    @foreach($jobs as $job)
                        <a href="{{ route('jobs.show', $job) }}" class="block group relative bg-slate-900 rounded-3xl p-6 border border-slate-800 hover:border-violet-500/40 overflow-hidden shadow-lg hover:shadow-[0_8px_30px_rgba(139,92,246,0.08)] transition-all duration-300 hover:-translate-x-1">
                            <div class="absolute right-0 top-0 h-full w-2 bg-gradient-to-b from-violet-600 to-fuchsia-600 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <div class="flex flex-col sm:flex-row gap-8 items-start sm:items-center">
                                <!-- Startup Logo -->
                                <div class="w-20 h-20 rounded-2xl bg-slate-950 border-2 border-slate-800 flex-shrink-0 overflow-hidden flex items-center justify-center shadow-inner group-hover:border-violet-900/50 transition-colors">
                                    @if($job->startup->logo)
                                        <img src="{{ asset('storage/' . $job->startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                        <span class="font-black text-violet-400 text-2xl">{{ substr($job->startup->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                
                                <div class="flex-grow w-full min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-3">
                                        <div>
                                            <h3 class="font-heading font-black text-2xl text-white group-hover:text-violet-300 transition-colors tracking-tight">{{ $job->title }}</h3>
                                            <p class="text-slate-400 font-bold mt-1 text-sm flex items-center gap-2">
                                                {{ $job->startup->name }}
                                                <span class="w-1 h-1 rounded-full bg-slate-700 flex-shrink-0"></span>
                                                <span class="text-slate-500 truncate">{{ $job->startup->category->name ?? 'Tech Startup' }}</span>
                                            </p>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-2 flex-shrink-0">
                                            <!-- Mock Badges -->
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                                Urgent Hire
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase bg-violet-900/30 text-violet-400 border border-violet-800/50">
                                                {{ $job->type }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="inline-flex flex-wrap items-center gap-x-5 gap-y-2 text-xs text-slate-500 mt-4 font-bold bg-slate-950 px-4 py-2 rounded-xl border border-slate-800">
                                        @if($job->salary_range)
                                            <span class="flex items-center gap-1.5 text-slate-300">
                                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $job->salary_range }}
                                            </span>
                                            <span class="w-px h-3 bg-slate-800"></span>
                                        @endif
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                            Remote / Global
                                        </span>
                                        <span class="w-px h-3 bg-slate-800"></span>
                                        <span class="flex items-center gap-1.5 text-slate-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Posted {{ $job->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="hidden md:flex items-center justify-center p-3 rounded-xl bg-slate-800 text-slate-400 group-hover:bg-violet-600 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    
                    <div class="mt-12">
                        {{ $jobs->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-slate-900 rounded-[2rem] border border-dashed border-slate-800">
                        <div class="w-20 h-20 rounded-3xl bg-slate-800/50 flex items-center justify-center mx-auto mb-6 border border-slate-700">
                            <svg class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-tight">No jobs found</h3>
                        <p class="mt-2 text-slate-400 max-w-sm mx-auto">We couldn't find any job postings matching your criteria. Try expanding your search terms.</p>
                        
                        @if(request()->has('search') && request()->search != '')
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Clear Search
                            </a>
                        @endif
                    </div>
                @endif
                </div>
            </div>
    </div>
</x-public-layout>
