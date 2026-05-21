<x-public-layout>
    <!-- Hero Section -->
    <div class="relative bg-slate-950 overflow-hidden border-b border-slate-900 pb-16 pt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/20 via-slate-900 to-cyan-900/10 pointer-events-none"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold uppercase tracking-widest border border-indigo-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Public Directory
            </span>
            <h1 class="font-heading text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">
                Startup <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Marketplace</span>
            </h1>
            <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                Discover the next generation of builders. Explore innovative startups across multiple industries, back visionary founders, and integrate cutting-edge products into your stack.
            </p>

            <!-- Mock Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Total Startups</p>
                    <p class="text-2xl font-black text-white">{{ $startups->total() }}</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Active Builders</p>
                    <p class="text-2xl font-black text-indigo-400">1.2k+</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Capital Raised</p>
                    <p class="text-2xl font-black text-emerald-400">$45M+</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Success Rate</p>
                    <p class="text-2xl font-black text-cyan-400">89%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 800)">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar / Filters -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <form action="{{ route('marketplace.index') }}" method="GET" class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            </div>
                            <h3 class="font-bold text-lg text-white">Filter Startups</h3>
                        </div>

                        <div class="space-y-6">
                            <!-- Category Filter -->
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Industry Category</label>
                                <select name="category" onchange="this.form.submit()" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-3 outline-none transition-colors appearance-none">
                                    <option value="">Explore All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Mock Stage Filter (For UI Fullness) -->
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Funding Stage</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-3 text-sm text-slate-400 hover:text-white cursor-pointer group">
                                        <input type="checkbox" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-500 focus:ring-indigo-500/50">
                                        <span class="group-hover:translate-x-1 transition-transform">Pre-Seed / Ideation</span>
                                    </label>
                                    <label class="flex items-center gap-3 text-sm text-slate-400 hover:text-white cursor-pointer group">
                                        <input type="checkbox" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-500 focus:ring-indigo-500/50">
                                        <span class="group-hover:translate-x-1 transition-transform">Seed Stage</span>
                                    </label>
                                    <label class="flex items-center gap-3 text-sm text-slate-400 hover:text-white cursor-pointer group">
                                        <input type="checkbox" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-500 focus:ring-indigo-500/50">
                                        <span class="group-hover:translate-x-1 transition-transform">Series A & Beyond</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-800">
                            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-xl shadow-[0_4px_15px_rgba(99,102,241,0.2)] hover:shadow-[0_6px_20px_rgba(99,102,241,0.4)] transition-all active:scale-95">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Startups Grid -->
            <div class="lg:col-span-3">
                <template x-if="loading">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="bg-slate-900 rounded-[2rem] border border-slate-800 overflow-hidden h-full shadow-lg animate-pulse flex flex-col">
                                <div class="h-40 w-full bg-slate-800/50"></div>
                                <div class="p-6 flex-grow flex flex-col relative z-20 -mt-12">
                                    <div class="flex justify-between items-end mb-4">
                                        <div class="w-20 h-20 rounded-2xl bg-slate-800 border-4 border-slate-900"></div>
                                        <div class="h-6 w-16 bg-slate-800 rounded-lg mb-2"></div>
                                    </div>
                                    <div class="h-6 w-3/4 bg-slate-800 rounded mb-4"></div>
                                    <div class="h-4 w-1/2 bg-slate-800 rounded mb-6"></div>
                                    <div class="space-y-2 mt-auto">
                                        <div class="h-3 bg-slate-800 rounded"></div>
                                        <div class="h-3 bg-slate-800 rounded w-5/6"></div>
                                    </div>
                                    <div class="mt-6 pt-5 border-t border-slate-800/80 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-800"></div>
                                            <div class="h-3 w-16 bg-slate-800 rounded"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </template>
                <div x-show="!loading" style="display: none;">
                @if($startups->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($startups as $startup)
                            <a href="{{ route('marketplace.show', $startup) }}" class="group relative bg-slate-900 rounded-[2rem] border border-slate-800 hover:border-indigo-500/40 overflow-hidden flex flex-col h-full shadow-lg hover:shadow-[0_8px_30px_rgba(99,102,241,0.1)] transition-all duration-500 hover:-translate-y-1">
                                <!-- Banner Image -->
                                <div class="h-40 w-full relative overflow-hidden bg-slate-950">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent z-10"></div>
                                    @if($startup->banner)
                                        <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 group-hover:scale-110 transition-transform duration-700"></div>
                                    @endif
                                </div>
                                
                                <div class="p-6 flex-grow flex flex-col relative z-20 -mt-12">
                                    <!-- Logo & Stage -->
                                    <div class="flex justify-between items-end mb-4">
                                        <div class="w-20 h-20 rounded-2xl bg-slate-950 border-4 border-slate-900 overflow-hidden flex items-center justify-center shadow-xl group-hover:border-indigo-900/50 transition-colors">
                                            @if($startup->logo)
                                                <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                            @else
                                                <span class="font-black text-indigo-400 text-2xl">{{ substr($startup->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <span class="px-3 py-1.5 text-[10px] font-black tracking-widest uppercase rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 shadow-inner mb-2">
                                            {{ $startup->stage }}
                                        </span>
                                    </div>
                                    
                                    <!-- Details -->
                                    <h3 class="font-bold text-2xl text-white group-hover:text-indigo-300 transition-colors tracking-tight">{{ $startup->name }}</h3>
                                    
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                            {{ $startup->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-sm text-slate-400 line-clamp-3 mt-4 flex-grow leading-relaxed">
                                        {{ $startup->description }}
                                    </p>
                                    <!-- Funding Progress (Mock) -->
                                    <div class="mt-5 mb-2">
                                        <div class="flex justify-between items-end mb-2">
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Funding Progress</span>
                                            <span class="text-xs font-black text-emerald-400">{{ ($startup->id * 23) % 100 }}% Raised</span>
                                        </div>
                                        <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden relative">
                                            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.5)]" style="width: {{ ($startup->id * 23) % 100 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Footer -->
                                    <div class="mt-6 pt-5 border-t border-slate-800/80 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-300 uppercase">
                                                {{ substr($startup->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs text-slate-500 font-medium">Founder</span>
                                                <span class="text-xs font-bold text-slate-300">{{ $startup->user->name }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="w-8 h-8 rounded-full bg-slate-800 group-hover:bg-indigo-600 text-slate-400 group-hover:text-white flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-12">
                        {{ $startups->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-slate-900 rounded-[2rem] border border-dashed border-slate-800">
                        <div class="w-20 h-20 rounded-3xl bg-slate-800/50 flex items-center justify-center mx-auto mb-6 border border-slate-700">
                            <svg class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-tight">No startups found</h3>
                        <p class="mt-2 text-slate-400 max-w-sm mx-auto">We couldn't find any startups matching your criteria. Try adjusting your filters or check back later.</p>
                        
                        @if(request()->has('category') && request()->category != '')
                            <a href="{{ route('marketplace.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Clear Filters
                            </a>
                        @endif
                    </div>
                @endif
                </div>
            </div>
            
        </div>
    </div>
</x-public-layout>
