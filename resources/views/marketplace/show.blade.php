<x-public-layout>
    <div class="max-w-6xl mx-auto px-6 sm:px-12 py-12">
        <!-- Banner -->
        <div class="h-64 sm:h-80 w-full relative rounded-3xl overflow-hidden border border-gray-800 shadow-2xl">
            @if($startup->banner)
                <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-r from-purple-900/50 to-cyan-900/50"></div>
            @endif
        </div>
        
        <!-- Profile Header -->
        <div class="relative px-8 -mt-16 flex flex-col sm:flex-row items-center sm:items-end gap-6 sm:gap-8 mb-12">
            <!-- Logo -->
            <div class="w-32 h-32 rounded-2xl bg-gray-900 border-4 border-gray-950 overflow-hidden shadow-xl flex items-center justify-center shrink-0">
                @if($startup->logo)
                    <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    <span class="font-bold text-gray-500 text-4xl">{{ substr($startup->name, 0, 1) }}</span>
                @endif
            </div>
            
            <div class="flex-grow text-center sm:text-left mb-2">
                <h1 class="font-heading text-4xl font-bold text-white mb-2">{{ $startup->name }}</h1>
                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-4 text-sm">
                    <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 font-medium">
                        {{ $startup->stage }}
                    </span>
                    <span class="text-gray-400 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        {{ $startup->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>
            
            <div class="mb-4 flex gap-4">
                <button class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-cyan-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                    Contact Founder
                </button>
                <button class="p-2.5 glass-panel text-gray-300 hover:text-white rounded-xl transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: About & Pitch -->
            <div class="lg:col-span-2 space-y-8">
                <div class="glass-panel p-8 rounded-2xl border border-gray-800">
                    <h2 class="text-xl font-bold text-white mb-4">About {{ $startup->name }}</h2>
                    <p class="text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $startup->description }}
                    </p>
                </div>
                
                <div class="glass-panel p-8 rounded-2xl border border-gray-800">
                    <h2 class="text-xl font-bold text-white mb-4">Products & Services</h2>
                    <div class="text-gray-500 text-center py-8">
                        No products listed yet.
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Info & Stats -->
            <div class="space-y-8">
                <div class="glass-panel p-6 rounded-2xl border border-gray-800">
                    <h3 class="text-lg font-bold text-white mb-4">Founder Information</h3>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-lg font-bold text-gray-400">
                            {{ substr($startup->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-medium text-white">{{ $startup->user->name }}</div>
                            <div class="text-sm text-gray-400">Startup Founder</div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 border-t border-gray-800 pt-4 mt-2">
                        Member since {{ $startup->user->created_at->format('M Y') }}
                    </div>
                </div>
                
                <div class="glass-panel p-6 rounded-2xl border border-gray-800 bg-gradient-to-br from-gray-900 to-gray-800">
                    <h3 class="text-lg font-bold text-white mb-2">Seeking Investment?</h3>
                    <p class="text-sm text-gray-400 mb-4">Investors can request access to the pitch deck and financial details.</p>
                    <button class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white border border-gray-600 rounded-lg transition-colors text-sm font-medium">
                        View Pitch Deck
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
