<x-public-layout>
    <div class="max-w-7xl mx-auto py-4">
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <h1 class="font-heading text-4xl font-bold text-white mb-2">Investor Ecosystem</h1>
                <p class="text-slate-400">Discover and connect with top investment partners, angel networks, and venture funds.</p>
            </div>
            
            <form action="{{ route('investors.index') }}" method="GET" class="flex gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, firm, bio..." class="bg-slate-900 border border-slate-800 text-slate-300 text-sm rounded-lg focus:ring-slate-700 focus:border-slate-700 block w-full pl-10 p-2.5 outline-none transition-colors">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-slate-100 hover:bg-white text-slate-950 font-bold text-sm rounded-lg border border-slate-200/50 transition-all">
                    Search
                </button>
            </form>
        </div>

        @if($investors->count() > 0)
            <!-- Investors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($investors as $investor)
                    <div class="group glass-panel rounded-2xl overflow-hidden flex flex-col h-full border border-slate-800 hover:border-slate-700 transition-all duration-300 p-6 relative">
                        <!-- Top details: Avatar & Verified badge -->
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-slate-200 text-xl">
                                    {{ substr($investor->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <h3 class="font-heading font-bold text-lg text-white group-hover:text-emerald-400 transition-colors">
                                            {{ $investor->user->name }}
                                        </h3>
                                        @if($investor->is_verified)
                                            <span class="text-emerald-500" title="Verified Investor">
                                                <svg class="w-4 h-4 inline-block fill-current" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6.267 3.455a.75.75 0 00-.708-.522 6.002 6.002 0 00-4.5 4.5.75.75 0 00.522.708 4.5 4.5 0 013.472 3.472.75.75 0 00.708.522 6.002 6.002 0 004.5-4.5.75.75 0 00-.522-.708 4.5 4.5 0 01-3.472-3.472zM15 10a5 5 0 11-10 0 5 5 0 0110 0zm-2.03-1.22a.75.75 0 00-1.06-1.06L9 10.44 8.03 9.47a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.06 0l3-3z" clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-slate-400 font-medium mt-0.5">
                                        {{ $investor->organization ?: 'Independent Investor' }}
                                    </p>
                                </div>
                            </div>

                            @if($investor->is_verified)
                                <span class="px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase rounded-full bg-emerald-900/30 text-emerald-400 border border-emerald-800/50">
                                    Verified
                                </span>
                            @endif
                        </div>

                        <!-- Investment Range -->
                        <div class="mb-5 bg-slate-900/60 rounded-xl p-3 border border-slate-800/80">
                            <span class="text-xs text-slate-500 block uppercase font-semibold tracking-wider mb-1">Typical Investment</span>
                            <span class="text-sm font-bold text-white">{{ $investor->investment_range ?: 'Not specified' }}</span>
                        </div>

                        <!-- Bio -->
                        <p class="text-sm text-slate-400 line-clamp-4 leading-relaxed mb-6 flex-grow">
                            {{ $investor->bio ?: 'No bio details provided.' }}
                        </p>

                        <!-- Contact Action -->
                        <div class="mt-auto border-t border-slate-850 pt-4 flex justify-between items-center text-xs text-slate-500">
                            <span>Joined {{ $investor->created_at->diffForHumans() }}</span>
                            @auth
                                <a href="mailto:{{ $investor->user->email }}" class="text-slate-200 hover:text-white font-semibold flex items-center gap-1">
                                    Contact
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition-colors flex items-center gap-1">
                                    Login to Connect
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $investors->links() }}
            </div>
        @else
            <!-- Empty state -->
            <div class="text-center py-20 glass-panel rounded-2xl border border-slate-800">
                <svg class="mx-auto h-12 w-12 text-slate-650 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="text-lg font-medium text-slate-300">No investors found</h3>
                <p class="mt-1 text-slate-500">Try adjusting your search criteria.</p>
            </div>
        @endif
    </div>
</x-public-layout>
