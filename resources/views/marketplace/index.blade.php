<x-public-layout>
    <div class="max-w-7xl mx-auto py-4">
        <!-- Header & Category Select -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
            <div>
                <h1 class="font-heading text-4xl font-bold text-white mb-2">Startup Ecosystem</h1>
                <p class="text-slate-400">Discover and invest in the builders of tomorrow.</p>
            </div>
            
            <form action="{{ route('marketplace.index') }}" method="GET" class="w-full md:w-auto">
                <select name="category" onchange="this.form.submit()" class="bg-slate-900 border border-slate-800 text-slate-300 text-sm rounded-xl focus:ring-slate-750 focus:border-slate-750 block w-full md:w-64 p-2.5 outline-none transition-colors">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($startups->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($startups as $startup)
                    <a href="{{ route('marketplace.show', $startup) }}" class="group glass-panel rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-300 flex flex-col h-full border border-slate-800/80 hover:border-slate-700">
                        <!-- Banner -->
                        <div class="h-32 bg-slate-900 w-full relative border-b border-slate-800/40">
                            @if($startup->banner)
                                <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-slate-900 to-slate-800"></div>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-grow flex flex-col relative">
                            <!-- Logo -->
                            <div class="absolute -top-10 left-6 w-16 h-16 rounded-xl bg-slate-900 border-2 border-slate-800 overflow-hidden flex items-center justify-center shadow-lg">
                                @if($startup->logo)
                                    <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-slate-500 text-lg">{{ substr($startup->name, 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <div class="mt-8 flex justify-between items-start mb-2">
                                <h3 class="font-heading font-bold text-xl text-white group-hover:text-blue-400 transition-colors">{{ $startup->name }}</h3>
                                <span class="px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-full bg-blue-900/30 text-blue-400 border border-blue-800/50">
                                    {{ $startup->stage }}
                                </span>
                            </div>
                            
                            <p class="text-xs text-slate-500 mb-4">{{ $startup->category->name ?? 'Uncategorized' }}</p>
                            
                            <p class="text-sm text-slate-400 line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ $startup->description }}
                            </p>
                            
                            <div class="mt-auto flex items-center gap-3 border-t border-slate-850 pt-4">
                                <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700/50 flex items-center justify-center text-xs font-bold text-slate-300">
                                    {{ substr($startup->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-slate-400 font-medium">{{ $startup->user->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $startups->links() }}
            </div>
        @else
            <div class="text-center py-20 glass-panel rounded-2xl border border-slate-800">
                <svg class="mx-auto h-12 w-12 text-slate-650 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-slate-300">No startups found</h3>
                <p class="mt-1 text-slate-500">Check back later or try a different category.</p>
            </div>
        @endif
    </div>
</x-public-layout>
