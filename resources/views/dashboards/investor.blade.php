<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Investor Console') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Session Messages -->
            @if(session('success'))
                <div class="p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($investor)
                <!-- Investor Profile Banner -->
                <div class="bg-gradient-to-r from-purple-900/40 to-cyan-900/40 p-8 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <div class="flex items-center gap-3">
                            <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $investor->organization ?? 'Independent Investor' }}</h3>
                            @if($investor->is_verified)
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 text-xs font-semibold rounded bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.585a.75.75 0 011.05-.12l2.25 1.875a.75.75 0 010 1.15l-2.25 1.875a.75.75 0 11-.96-1.15l1.56-1.3-1.56-1.3a.75.75 0 01-.12-1.05z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Verified
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-cyan-400 mt-1">Focus: {{ $investor->investment_range ?? 'Seed & Pre-Seed' }}</p>
                        <p class="text-gray-400 mt-3 text-sm max-w-2xl">{{ $investor->bio }}</p>
                    </div>
                </div>

                <!-- Stats Overview Grid -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Available Dealflow</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $startups->count() }} Startups</h4>
                    </div>
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Active Pitch Decks</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $fundingRequests->count() }} Submissions</h4>
                    </div>
                </div>

                <!-- Startups Showcase Grid -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Startups Portfolio Showcase</h3>
                        <a href="{{ route('marketplace.index') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold text-sm">Explore Marketplace &rarr;</a>
                    </div>
                    
                    @if($startups->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($startups as $startup)
                                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 hover:border-cyan-500/40 transition-all flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-gray-900 border border-gray-700 flex items-center justify-center font-bold text-white text-sm">
                                                {{ substr($startup->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $startup->name }}</h4>
                                                <span class="text-xs text-gray-400">{{ $startup->category->name ?? 'Uncategorized' }}</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4 line-clamp-3">{{ $startup->description }}</p>
                                    </div>
                                    <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200 dark:border-gray-800 text-xs">
                                        <span class="text-gray-400">Stage: <strong class="text-gray-300">{{ $startup->stage }}</strong></span>
                                        <a href="{{ route('marketplace.show', $startup) }}" class="text-cyan-400 hover:text-cyan-300 font-semibold">View Detail Profile &rarr;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                            No startups currently published.
                        </div>
                    @endif
                </div>

                <!-- Pitch Decks and Funding Pipeline -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                        <h3 class="font-bold text-gray-900 dark:text-white">Active Funding Submissions</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Review direct investment options and pitch decks uploaded by startups.</p>
                    </div>
                    @if($fundingRequests->count() > 0)
                        <div class="divide-y divide-gray-200 dark:divide-gray-800">
                            @foreach($fundingRequests as $request)
                                <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $request->startup->name }}</h4>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                                                {{ $request->status }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-xl">{{ $request->description }}</p>
                                        <div class="flex gap-4 text-xs text-gray-400 mt-3">
                                            <span>Funding Target: <strong class="text-cyan-400">${{ number_format($request->amount_needed) }}</strong></span>
                                            <span>&bull;</span>
                                            <span>Equity Offered: <strong class="text-cyan-400">{{ $request->equity_offered }}%</strong></span>
                                        </div>
                                    </div>

                                    @if($request->pitch_deck)
                                        <a href="{{ asset('storage/' . $request->pitch_deck) }}" target="_blank" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-semibold rounded-lg transition-colors border border-gray-700">
                                            View Pitch Deck
                                        </a>
                                    @else
                                        <button class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-gray-800/50 text-gray-500 text-sm font-semibold rounded-lg cursor-not-allowed border border-gray-800">
                                            No Pitch Deck
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                            No funding requests currently requested.
                        </div>
                    @endif
                </div>

            @else
                <!-- Missing Investor Profile Warning -->
                <div class="p-8 bg-cyan-500/10 rounded-2xl border border-cyan-500/20 text-center space-y-4 max-w-xl mx-auto">
                    <div class="w-16 h-16 rounded-full bg-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Create your Investor Profile</h3>
                    <p class="text-gray-400">You must set up your profile details to unlock startups showcase dealflow and funding requests pipelines.</p>
                    <div class="pt-2">
                        <a href="{{ route('investors.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-cyan-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                            Build Investor Profile
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
