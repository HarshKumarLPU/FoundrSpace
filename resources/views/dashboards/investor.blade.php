<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-emerald-500/10 rounded-full border border-emerald-500/20">
                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-100 leading-tight font-serif tracking-wide">
                {{ __('Investor Console') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-10">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-5 bg-emerald-950/40 border border-emerald-500/30 text-emerald-200 rounded-2xl flex items-center gap-4 shadow-[0_4px_20px_rgba(16,185,129,0.15)] animate-fade-in-down">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                    <svg class="w-4 h-4 flex-shrink-0 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-semibold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if($investor)
            <!-- Investor Profile Banner -->
            <div class="relative overflow-hidden p-10 rounded-[2rem] border border-emerald-900/40 bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_10px_40px_rgba(16,185,129,0.06)] flex flex-col md:flex-row justify-between items-start md:items-center gap-8 group">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-emerald-500/20 transition-all duration-700"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-4">
                        <h3 class="text-3xl font-bold text-white tracking-tight">{{ $investor->organization ?? 'Independent Investor' }}</h3>
                        @if($investor->is_verified)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-[0_0_10px_rgba(16,185,129,0.2)]">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.585a.75.75 0 011.05-.12l2.25 1.875a.75.75 0 010 1.15l-2.25 1.875a.75.75 0 11-.96-1.15l1.56-1.3-1.56-1.3a.75.75 0 01-.12-1.05z" clip-rule="evenodd"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified Partner
                            </span>
                        @endif
                    </div>
                    <div class="mt-4 flex items-center gap-6">
                        <div class="flex items-center gap-2 text-sm text-emerald-200/70 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Focus: <strong class="text-emerald-100">{{ $investor->investment_range ?? 'Seed & Pre-Seed' }}</strong>
                        </div>
                    </div>
                    <p class="text-slate-400 mt-5 text-sm max-w-2xl leading-relaxed border-l-2 border-emerald-500/30 pl-4 italic">{{ $investor->bio }}</p>
                </div>
            </div>

            <!-- Analytics & Stats Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Analytics Chart -->
                <div class="lg:col-span-1 relative overflow-hidden rounded-[2rem] p-8 border border-emerald-900/30 bg-slate-900/50 shadow-sm hover:shadow-[0_10px_30px_rgba(16,185,129,0.08)] transition-all duration-300">
                    <h4 class="font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        Dealflow by Category
                    </h4>
                    <div class="h-48 w-full relative">
                        <canvas id="investorAnalyticsChart"></canvas>
                    </div>
                </div>

                <!-- Stats -->
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="relative overflow-hidden rounded-[2rem] p-8 border border-emerald-900/30 bg-slate-900/50 shadow-sm text-center hover:shadow-[0_10px_30px_rgba(16,185,129,0.08)] hover:-translate-y-1 transition-all duration-300 group">
                        <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/5 to-transparent"></div>
                        <div class="w-12 h-12 rounded-full bg-emerald-500/10 text-emerald-400 mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <p class="text-[11px] font-bold text-emerald-200/60 uppercase tracking-widest relative z-10">Available Dealflow</p>
                        <h4 class="text-5xl font-black text-white mt-3 tracking-tight relative z-10">{{ $startups->count() }} <span class="text-lg text-slate-500 font-medium tracking-normal">Startups</span></h4>
                    </div>
                    <div class="relative overflow-hidden rounded-[2rem] p-8 border border-teal-900/30 bg-slate-900/50 shadow-sm text-center hover:shadow-[0_10px_30px_rgba(20,184,166,0.08)] hover:-translate-y-1 transition-all duration-300 group">
                        <div class="absolute inset-0 bg-gradient-to-b from-teal-900/5 to-transparent"></div>
                        <div class="w-12 h-12 rounded-full bg-teal-500/10 text-teal-400 mx-auto flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-[11px] font-bold text-teal-200/60 uppercase tracking-widest relative z-10">Active Pitch Decks</p>
                        <h4 class="text-5xl font-black text-white mt-3 tracking-tight relative z-10">{{ $fundingRequests->count() }} <span class="text-lg text-slate-500 font-medium tracking-normal">Submissions</span></h4>
                    </div>
                </div>
            </div>

            <!-- Startups Showcase Grid -->
            <div class="space-y-6">
                <div class="flex justify-between items-end pb-4 border-b border-emerald-900/20">
                    <div>
                        <h3 class="text-2xl font-bold text-white tracking-tight">Portfolio Showcase</h3>
                        <p class="text-sm text-slate-400 mt-1">Curated startups currently open for seed funding and strategic partnerships.</p>
                    </div>
                    <a href="{{ route('marketplace.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-slate-800 hover:bg-slate-700 text-emerald-400 font-semibold text-sm transition-colors border border-emerald-900/30">
                        Explore Full Directory
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                
                @if($startups->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($startups as $startup)
                            <div class="relative overflow-hidden rounded-3xl p-7 border border-emerald-900/20 bg-slate-900/40 hover:bg-slate-900 hover:border-emerald-500/30 shadow-sm hover:shadow-[0_8px_30px_rgba(16,185,129,0.1)] transition-all duration-300 flex flex-col justify-between group">
                                <div>
                                    <div class="flex justify-between items-start mb-6">
                                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-950 to-slate-900 border-2 border-emerald-900/50 flex items-center justify-center font-bold text-emerald-400 text-xl shadow-inner group-hover:scale-110 transition-transform duration-500">
                                            {{ substr($startup->name, 0, 1) }}
                                        </div>
                                        <span class="px-3 py-1 text-[10px] font-black rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-widest">
                                            {{ $startup->stage }}
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-white text-xl tracking-tight">{{ $startup->name }}</h4>
                                    <span class="text-xs font-semibold text-teal-400/80 mt-1 block uppercase tracking-wider">{{ $startup->category->name ?? 'Uncategorized' }}</span>
                                    <p class="text-sm text-slate-400 mt-4 line-clamp-3 leading-relaxed">{{ $startup->description }}</p>
                                </div>
                                <div class="mt-8 pt-5 border-t border-emerald-900/20">
                                    <a href="{{ route('marketplace.show', $startup) }}" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-full bg-emerald-950/30 hover:bg-emerald-600 hover:text-white text-emerald-400 font-bold text-sm transition-colors border border-emerald-900/50 hover:border-emerald-500">
                                        View Deep Dive
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-500 bg-slate-900/30 rounded-3xl border border-dashed border-emerald-900/30 flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-emerald-900/50 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="font-medium text-slate-400">No startups currently published.</p>
                    </div>
                @endif
            </div>

            <!-- Pitch Decks and Funding Pipeline -->
            <div class="rounded-3xl border border-teal-900/30 bg-slate-900/40 shadow-sm overflow-hidden mt-10 relative">
                <div class="absolute top-0 right-0 w-96 h-96 bg-teal-500/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                <div class="p-8 border-b border-teal-900/30 bg-teal-950/10 flex justify-between items-center relative z-10">
                    <div>
                        <h3 class="font-bold text-2xl text-white tracking-tight flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Active Funding Submissions
                        </h3>
                        <p class="text-sm text-slate-400 mt-2">Review direct investment options and pitch decks uploaded by startups.</p>
                    </div>
                </div>
                @if($fundingRequests->count() > 0)
                    <div class="divide-y divide-teal-900/20 relative z-10">
                        @foreach($fundingRequests as $request)
                            <div class="p-8 hover:bg-slate-800/30 transition-colors flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-4">
                                        <h4 class="font-bold text-white text-xl">{{ $request->startup->name }}</h4>
                                        <span class="px-3 py-1 text-[10px] font-black rounded-full bg-teal-500/10 text-teal-400 border border-teal-500/20 uppercase tracking-widest shadow-inner">
                                            {{ $request->status }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-slate-400 mt-3 max-w-3xl leading-relaxed">{{ $request->description }}</p>
                                    <div class="flex flex-wrap gap-6 text-sm text-slate-500 mt-5 bg-slate-950/40 inline-flex px-5 py-3 rounded-2xl border border-slate-800/60">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-emerald-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Funding Target: <strong class="text-emerald-300 font-bold">${{ number_format($request->amount_needed) }}</strong>
                                        </div>
                                        <div class="w-px h-5 bg-slate-700/50 hidden sm:block"></div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-teal-400/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                                            Equity Offered: <strong class="text-teal-300 font-bold">{{ $request->equity_offered }}%</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full lg:w-auto shrink-0 pt-4 lg:pt-0">
                                    @if($request->pitch_deck)
                                        <a href="{{ asset('storage/' . $request->pitch_deck) }}" target="_blank" class="w-full lg:w-auto inline-flex justify-center items-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold rounded-full transition-all shadow-[0_4px_15px_rgba(16,185,129,0.3)] hover:shadow-[0_6px_20px_rgba(16,185,129,0.4)] hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Download Pitch Deck
                                        </a>
                                    @else
                                        <button class="w-full lg:w-auto inline-flex justify-center items-center px-6 py-3.5 bg-slate-800/40 text-slate-500 text-sm font-bold rounded-full cursor-not-allowed border border-slate-800">
                                            No Deck Available
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-500 relative z-10">
                        <svg class="w-12 h-12 text-teal-900/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        No funding requests currently requested.
                    </div>
                @endif
            </div>

            <!-- Outgoing Investment Proposals Tracking -->
            <div class="rounded-3xl border border-indigo-900/30 bg-slate-900/40 shadow-sm overflow-hidden mt-10 relative">
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                <div class="p-8 border-b border-indigo-900/30 bg-indigo-950/10 flex justify-between items-center relative z-10">
                    <div>
                        <h3 class="font-bold text-2xl text-white tracking-tight flex items-center gap-3">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            My Investment Proposals
                        </h3>
                        <p class="text-sm text-slate-400 mt-2">Track the status of the investment offers you have sent to startups.</p>
                    </div>
                </div>
                @if($investmentProposals->count() > 0)
                    <div class="divide-y divide-indigo-900/20 relative z-10">
                        @foreach($investmentProposals as $proposal)
                            <div class="p-8 hover:bg-slate-800/30 transition-colors flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-4">
                                        <h4 class="font-bold text-white text-xl">{{ $proposal->startup->name }}</h4>
                                        <span class="px-3 py-1 text-[10px] font-black rounded-full {{ $proposal->status === 'pending' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : ($proposal->status === 'accepted' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700') }} uppercase tracking-widest shadow-inner">
                                            {{ $proposal->status }}
                                        </span>
                                    </div>
                                    <div class="text-sm font-black text-white mt-3 bg-slate-950/50 px-3 py-2 rounded inline-block border border-slate-800">
                                        Offer: <span class="text-indigo-400">{{ $proposal->proposed_amount }}</span>
                                    </div>
                                    <p class="text-sm text-slate-400 mt-3 max-w-3xl leading-relaxed">{{ Str::limit($proposal->message, 150) }}</p>
                                </div>
                                <div class="w-full lg:w-auto shrink-0 pt-4 lg:pt-0">
                                    <a href="{{ route('marketplace.show', $proposal->startup) }}" class="w-full lg:w-auto inline-flex justify-center items-center gap-2 px-6 py-3.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-bold rounded-full transition-all border border-slate-700">
                                        View Startup
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-500 relative z-10">
                        <svg class="w-12 h-12 text-indigo-900/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        You haven't proposed any investments yet.
                    </div>
                @endif
            </div>

        @else
            <!-- Missing Investor Profile Warning -->
            <div class="p-12 bg-emerald-950/20 rounded-[2.5rem] border border-emerald-900/50 text-center space-y-6 max-w-2xl mx-auto shadow-[0_0_40px_rgba(16,185,129,0.1)] relative overflow-hidden mt-10">
                <div class="absolute inset-0 bg-gradient-to-tr from-emerald-900/20 to-transparent pointer-events-none"></div>
                <div class="w-24 h-24 rounded-full bg-emerald-900/40 text-emerald-400 flex items-center justify-center mx-auto border border-emerald-500/20 shadow-inner relative z-10">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-3xl font-black text-white relative z-10 tracking-tight">Create your Investor Profile</h3>
                <p class="text-slate-400 text-base leading-relaxed relative z-10 font-medium max-w-lg mx-auto">You must set up your profile details to unlock startups showcase dealflow and funding requests pipelines.</p>
                <div class="pt-6 relative z-10">
                    <a href="{{ route('investors.create') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-full hover:scale-105 transition-all text-sm shadow-[0_10px_20px_rgba(16,185,129,0.3)] uppercase tracking-widest">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Build Investor Profile
                    </a>
                </div>
            </div>
        @endif

    </div>

    <!-- Chart Initialization -->
    @if($investor)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('investorAnalyticsChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['SaaS', 'Fintech', 'Healthtech', 'AI/ML'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: [
                            '#10b981', // Emerald 500
                            '#14b8a6', // Teal 500
                            '#0f766e', // Teal 700
                            '#047857'  // Emerald 700
                        ],
                        borderColor: '#0f172a', // Slate 900
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: '#94a3b8',
                                font: { size: 10 },
                                boxWidth: 12
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', // Slate 900
                            titleColor: '#f1f5f9',
                            bodyColor: '#cbd5e1',
                            borderColor: '#334155',
                            borderWidth: 1,
                            padding: 10
                        }
                    },
                    cutout: '75%'
                }
            });
        });
    </script>
    @endif
</x-app-layout>
