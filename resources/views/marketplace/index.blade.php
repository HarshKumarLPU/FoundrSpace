<x-public-layout>
    <div class="max-w-7xl mx-auto px-6 sm:px-12 py-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
            <div>
                <h1 class="font-heading text-4xl font-bold text-white mb-2">Startup Ecosystem</h1>
                <p class="text-gray-400">Discover and invest in the next big thing.</p>
            </div>
            
            <form action="{{ route('marketplace.index') }}" method="GET" class="flex gap-4 w-full md:w-auto">
                <select name="category" onchange="this.form.submit()" class="bg-gray-900/50 border border-gray-700 text-gray-300 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full md:w-64 p-2.5">
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
                    <a href="{{ route('marketplace.show', $startup) }}" class="group glass-panel rounded-2xl overflow-hidden hover:scale-[1.02] transition-transform duration-300 flex flex-col h-full border border-gray-800 hover:border-cyan-500/50">
                        <!-- Banner -->
                        <div class="h-32 bg-gray-800 w-full relative">
                            @if($startup->banner)
                                <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-purple-900/50 to-cyan-900/50"></div>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-grow flex flex-col relative">
                            <!-- Logo -->
                            <div class="absolute -top-10 left-6 w-16 h-16 rounded-xl bg-gray-900 border-2 border-gray-800 overflow-hidden flex items-center justify-center">
                                @if($startup->logo)
                                    <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-gray-500">{{ substr($startup->name, 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <div class="mt-8 flex justify-between items-start mb-2">
                                <h3 class="font-heading font-bold text-xl text-white group-hover:text-cyan-400 transition-colors">{{ $startup->name }}</h3>
                                <span class="px-2.5 py-1 text-[10px] font-semibold tracking-wider uppercase rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                                    {{ $startup->stage }}
                                </span>
                            </div>
                            
                            <p class="text-xs text-gray-500 mb-4">{{ $startup->category->name ?? 'Uncategorized' }}</p>
                            
                            <p class="text-sm text-gray-400 line-clamp-3 mb-6 flex-grow">
                                {{ $startup->description }}
                            </p>
                            
                            <div class="mt-auto flex items-center gap-3 border-t border-gray-800 pt-4">
                                <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-400">
                                    {{ substr($startup->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-400">{{ $startup->user->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-12">
                {{ $startups->links() }}
            </div>
        @else
            <div class="text-center py-20 glass-panel rounded-2xl border border-gray-800">
                <svg class="mx-auto h-12 w-12 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-gray-300">No startups found</h3>
                <p class="mt-1 text-gray-500">Check back later or try a different category.</p>
            </div>
        @endif
    </div>
</x-public-layout>
