<x-public-layout>
    <!-- Hero Section -->
    <div class="relative bg-slate-950 overflow-hidden border-b border-slate-900 pb-16 pt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/20 via-slate-900 to-teal-900/10 pointer-events-none"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold uppercase tracking-widest border border-emerald-500/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Capital & Networks
            </span>
            <h1 class="font-heading text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">
                Investor <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">Ecosystem</span>
            </h1>
            <p class="text-lg text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                Connect with visionary angel investors, active venture funds, and strategic partners ready to fuel the next wave of technological innovation.
            </p>

            <!-- Mock Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Total Investors</p>
                    <p class="text-2xl font-black text-white">{{ $investors->total() }}</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Capital Deployed</p>
                    <p class="text-2xl font-black text-emerald-400">$120M+</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Avg Check Size</p>
                    <p class="text-2xl font-black text-teal-400">$500k</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-slate-800 shadow-inner hidden md:block">
                    <p class="text-[10px] uppercase font-black tracking-widest text-slate-500 mb-1">Active Funds</p>
                    <p class="text-2xl font-black text-white">45+</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Top Filters -->
        <div class="mb-10">
            <form action="{{ route('investors.index') }}" method="GET" class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                <div class="flex flex-col lg:flex-row items-start lg:items-end gap-6">
                    
                    <div class="flex items-center gap-3 lg:w-48 flex-shrink-0">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-white leading-tight">Search Directory</h3>
                            <p class="text-xs text-slate-500 font-medium">Find investors</p>
                        </div>
                    </div>

                    <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-6 w-full items-end">
                        <!-- Keyword Search -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Keywords</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, firm, or bio..." class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-3 outline-none transition-colors">
                        </div>
                        
                        <!-- Investment Focus Filter -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Investment Focus</label>
                            <select name="focus" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-3 outline-none transition-colors appearance-none">
                                <option value="">Any Focus</option>
                                <option value="angel" {{ request('focus') == 'angel' ? 'selected' : '' }}>Angel / Pre-Seed</option>
                                <option value="venture" {{ request('focus') == 'venture' ? 'selected' : '' }}>Venture / Seed</option>
                                <option value="private_equity" {{ request('focus') == 'private_equity' ? 'selected' : '' }}>Private Equity</option>
                            </select>
                        </div>
                        
                        <!-- Investor Type Filter -->
                        <div class="w-full md:col-span-1">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Investor Type</label>
                            <select name="type" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 p-3 outline-none transition-colors appearance-none">
                                <option value="">All Investors</option>
                                <option value="verified" {{ request('type') == 'verified' ? 'selected' : '' }}>Verified Partner Only</option>
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="w-full md:col-span-1">
                            <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold rounded-xl shadow-[0_4px_15px_rgba(16,185,129,0.2)] hover:shadow-[0_6px_20px_rgba(16,185,129,0.4)] transition-all active:scale-95 h-[46px] flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Search Investors
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Investors Grid -->
        <div class="w-full">
            @if($investors->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($investors as $investor)
                            <div class="group relative bg-slate-900 rounded-[2rem] border border-slate-800 hover:border-emerald-500/40 overflow-hidden flex flex-col h-full shadow-lg hover:shadow-[0_8px_30px_rgba(16,185,129,0.08)] transition-all duration-500 p-8">
                                <!-- Top details: Avatar & Verified badge -->
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border-2 border-slate-800 flex items-center justify-center font-black text-emerald-400 text-2xl shadow-inner group-hover:border-emerald-900/50 transition-colors">
                                            {{ substr($investor->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h3 class="font-heading font-bold text-xl text-white group-hover:text-emerald-300 transition-colors tracking-tight">
                                                    {{ $investor->user->name }}
                                                </h3>
                                                @if($investor->is_verified)
                                                    <span class="text-emerald-500" title="Verified Investor">
                                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6.267 3.455a.75.75 0 00-.708-.522 6.002 6.002 0 00-4.5 4.5.75.75 0 00.522.708 4.5 4.5 0 013.472 3.472.75.75 0 00.708.522 6.002 6.002 0 004.5-4.5.75.75 0 00-.522-.708 4.5 4.5 0 01-3.472-3.472zM15 10a5 5 0 11-10 0 5 5 0 0110 0zm-2.03-1.22a.75.75 0 00-1.06-1.06L9 10.44 8.03 9.47a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.06 0l3-3z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-slate-400 font-medium mt-1">
                                                {{ $investor->organization ?: 'Independent Investor' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Investment Range Tag -->
                                <div class="mb-5 inline-flex items-center gap-2 bg-slate-950 rounded-xl px-4 py-2.5 border border-slate-800">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-xs text-slate-500 font-bold uppercase tracking-wider">Target:</span>
                                    <span class="text-sm font-bold text-emerald-100">{{ $investor->investment_range ?: 'Not specified' }}</span>
                                </div>

                                <!-- Bio -->
                                <p class="text-sm text-slate-400 line-clamp-3 leading-relaxed mb-8 flex-grow">
                                    {{ $investor->bio ?: 'No bio details provided.' }}
                                </p>

                                <!-- Contact Action -->
                                <div class="mt-auto pt-5 border-t border-slate-800 flex justify-between items-center text-xs">
                                    <span class="text-slate-500 font-medium">Joined {{ $investor->created_at->format('M Y') }}</span>
                                    @auth
                                        @if(auth()->id() === $investor->user_id)
                                            <span class="text-emerald-400 font-bold bg-emerald-500/10 px-3 py-1.5 rounded-lg border border-emerald-500/20 shadow-inner flex items-center gap-1.5 uppercase tracking-widest text-[10px]">
                                                Your Profile
                                            </span>
                                        @else
                                            <a href="mailto:{{ $investor->user->email }}" class="inline-flex justify-center items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-white text-slate-900 font-bold rounded-xl transition-all shadow-sm">
                                                Pitch Deck
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-emerald-400 font-bold transition-colors flex items-center gap-1 uppercase tracking-widest text-[10px]">
                                            Login to Pitch
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $investors->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-slate-900 rounded-[2rem] border border-dashed border-slate-800">
                        <div class="w-20 h-20 rounded-3xl bg-slate-800/50 flex items-center justify-center mx-auto mb-6 border border-slate-700">
                            <svg class="h-10 w-10 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-tight">No investors found</h3>
                        <p class="mt-2 text-slate-400 max-w-sm mx-auto">We couldn't find any investors matching your search. Try different keywords or clear your search.</p>
                        
                        @if(request()->has('search') && request()->search != '')
                            <a href="{{ route('investors.index') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Clear Search
                            </a>
                        @endif
                    </div>
                @endif
            </div>
    </div>
</x-public-layout>
