<x-public-layout>
    <!-- Premium Hero Header -->
    <div class="relative bg-slate-950 pt-24 pb-32 overflow-hidden border-b border-slate-900 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-900/20 via-slate-900/50 to-slate-950 pointer-events-none z-0"></div>
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-indigo-500/10 rounded-full blur-3xl -mr-40 -mt-40 pointer-events-none z-0"></div>
        <div class="absolute top-0 left-0 w-[40rem] h-[40rem] bg-cyan-500/10 rounded-full blur-3xl -ml-40 -mt-40 pointer-events-none z-0"></div>
        
        <!-- Banner Image Overlay if present -->
        @if($startup->banner)
            <div class="absolute inset-0 z-0 opacity-20">
                <img src="{{ asset('storage/' . $startup->banner) }}" alt="Banner" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent"></div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="{{ route('marketplace.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-white transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                Back to Directory
            </a>

            <div class="flex flex-col md:flex-row items-start md:items-end gap-8">
                <!-- Glowing Logo -->
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-3xl bg-slate-900 border-2 border-indigo-500/30 overflow-hidden shadow-[0_0_30px_rgba(99,102,241,0.2)] flex items-center justify-center shrink-0 relative group">
                    <div class="absolute inset-0 bg-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @if($startup->logo)
                        <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover relative z-10">
                    @else
                        <span class="font-black text-indigo-400 text-6xl relative z-10">{{ substr($startup->name, 0, 1) }}</span>
                    @endif
                </div>
                
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="px-4 py-1.5 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 font-black text-[11px] uppercase tracking-widest shadow-inner">
                            {{ $startup->stage }}
                        </span>
                        <span class="px-4 py-1.5 rounded-lg bg-slate-800 text-slate-300 border border-slate-700 font-bold text-[11px] uppercase tracking-widest flex items-center gap-1.5 shadow-inner">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            {{ $startup->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <h1 class="font-heading text-5xl md:text-6xl font-black text-white mb-2 tracking-tight flex items-center gap-3">
                        {{ $startup->name }}
                        @if($startup->is_verified)
                            <svg class="w-10 h-10 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        @endif
                    </h1>
                    <p class="text-xl text-slate-400 font-medium">Building the future of {{ strtolower($startup->category->name ?? 'technology') }}.</p>
                </div>
                
                <!-- CTA Actions -->
                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4 mt-6 md:mt-0">
                    @if(auth()->check() && auth()->id() === $startup->user_id)
                        <span class="px-8 py-4 bg-indigo-500/10 text-indigo-400 font-bold rounded-2xl border border-indigo-500/20 shadow-inner flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            This is your Startup Profile
                        </span>
                    @else
                        @if(auth()->check() && auth()->user()->role === 'investor')
                            @php
                                $hasProposed = \App\Models\InvestmentProposal::where('startup_id', $startup->id)
                                    ->where('investor_id', auth()->user()->investor->id)
                                    ->exists();
                            @endphp
                            @if($hasProposed)
                                <button disabled class="px-8 py-4 bg-slate-800 text-slate-500 font-black rounded-2xl cursor-not-allowed w-full sm:w-auto flex justify-center items-center gap-2">
                                    Proposal Submitted
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            @else
                                <div x-data="{ openInvestModal: false }">
                                    <button @click="openInvestModal = true" class="px-8 py-4 bg-emerald-500 text-white hover:bg-emerald-400 font-black rounded-2xl shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] transition-all duration-300 hover:-translate-y-1 w-full sm:w-auto flex justify-center items-center gap-2">
                                        Propose Investment
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    
                                    <!-- Invest Modal -->
                                    <template x-teleport="body">
                                        <div x-show="openInvestModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
                                            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                                                <div x-show="openInvestModal" @click="openInvestModal = false" class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                    <div class="absolute inset-0 bg-slate-950 opacity-80 backdrop-blur-sm"></div>
                                                </div>
                                                <div x-show="openInvestModal" class="relative inline-block align-bottom bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-800">
                                                    <form action="{{ route('startups.invest', $startup) }}" method="POST" class="p-8">
                                                        @csrf
                                                        <h3 class="text-2xl font-black text-white mb-6">Propose Investment</h3>
                                                        
                                                        <div class="mb-6">
                                                            <label for="proposed_amount" class="block text-sm font-bold text-slate-400 mb-2">Proposed Amount / Range</label>
                                                            <input type="text" name="proposed_amount" id="proposed_amount" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500" placeholder="e.g. $50k - $100k" required>
                                                        </div>
                                                        
                                                        <div class="mb-6">
                                                            <label for="message" class="block text-sm font-bold text-slate-400 mb-2">Message to Founder</label>
                                                            <textarea name="message" id="message" rows="4" class="w-full bg-slate-950 border border-slate-800 text-white rounded-xl px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Introduce yourself and explain why you're interested in investing..." required></textarea>
                                                        </div>
                                                        
                                                        <div class="flex justify-end gap-3 mt-8">
                                                            <button type="button" @click="openInvestModal = false" class="px-6 py-2.5 rounded-xl text-slate-400 font-bold hover:text-white hover:bg-slate-800 transition-colors">Cancel</button>
                                                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-lg transition-all">Send Proposal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            @endif
                        @else
                            <a href="mailto:{{ $startup->user->email }}" class="px-8 py-4 bg-white text-slate-950 hover:bg-indigo-50 font-black rounded-2xl border border-white shadow-[0_0_20px_rgba(255,255,255,0.15)] hover:shadow-[0_0_30px_rgba(255,255,255,0.3)] transition-all duration-300 hover:-translate-y-1 w-full sm:w-auto flex justify-center items-center gap-2">
                                Contact Founder
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endif
                        <form action="{{ route('bookmarks.toggle', $startup) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-4 bg-slate-900 hover:bg-slate-800 {{ auth()->check() && auth()->user()->bookmarks()->where('startup_id', $startup->id)->exists() ? 'text-rose-500' : 'text-slate-300' }} hover:text-rose-400 rounded-2xl transition-all duration-300 border border-slate-700 hover:border-slate-500 shadow-lg hover:shadow-xl w-full sm:w-auto flex justify-center items-center group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform {{ auth()->check() && auth()->user()->bookmarks()->where('startup_id', $startup->id)->exists() ? 'fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-10 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Main Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- About Section -->
                <div class="bg-slate-900 rounded-[2rem] p-8 md:p-10 border border-slate-800 shadow-xl relative overflow-hidden group hover:border-indigo-500/30 transition-colors duration-500">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none transition-opacity duration-500 opacity-50 group-hover:opacity-100"></div>
                    <h2 class="text-2xl font-black text-white mb-6 tracking-tight flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        About the Company
                    </h2>
                    <div class="prose prose-invert max-w-none">
                        <p class="text-slate-300 leading-relaxed text-lg whitespace-pre-line font-medium">
                            {{ $startup->description }}
                        </p>
                    </div>
                </div>
                
                <!-- Mock Products & Services Tab Area -->
                <div class="bg-slate-900 rounded-[2rem] p-8 md:p-10 border border-slate-800 shadow-xl">
                    <div class="flex items-center justify-between border-b border-slate-800 pb-6 mb-8">
                        <h2 class="text-2xl font-black text-white tracking-tight flex items-center gap-3">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Products & Services
                        </h2>
                        <span class="text-sm font-bold text-slate-500 uppercase tracking-widest">Live Offerings</span>
                    </div>
                    <div class="text-center py-16 bg-slate-950/50 rounded-2xl border border-dashed border-slate-800">
                        <svg class="w-12 h-12 text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <p class="text-slate-400 font-medium">This startup hasn't listed any public products yet.</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Analytics & Founder -->
            <div class="space-y-8">
                
                <!-- Premium Funding Progress Widget -->
                <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-xl relative overflow-hidden group hover:border-emerald-500/30 transition-colors duration-500">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <h3 class="text-lg font-black text-white mb-2 relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Funding Progress
                    </h3>
                    <p class="text-sm text-slate-400 mb-6 relative z-10">Current seed round tracking.</p>
                    
                    @if($startup->funding_goal > 0)
                        @php
                            $fundingPercentage = min(100, round(($startup->funding_raised / $startup->funding_goal) * 100));
                        @endphp
                        <div class="relative z-10">
                            <div class="flex justify-between items-end mb-3">
                                <span class="text-sm font-bold text-slate-300">Target: <span class="text-white">${{ number_format($startup->funding_goal) }}</span></span>
                                <span class="text-2xl font-black text-emerald-400">{{ $fundingPercentage }}%</span>
                            </div>
                            <div class="w-full h-3 bg-slate-950 rounded-full overflow-hidden border border-slate-800 shadow-inner">
                                <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-400 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)] relative" style="width: {{ $fundingPercentage }}%">
                                    <div class="absolute inset-0 bg-white/20 w-full h-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="relative z-10">
                            <div class="flex justify-between items-end mb-3">
                                <span class="text-sm font-bold text-slate-300">Target: <span class="text-white">Undisclosed</span></span>
                                <span class="text-2xl font-black text-slate-400">N/A</span>
                            </div>
                            <div class="w-full h-3 bg-slate-950 rounded-full overflow-hidden border border-slate-800 shadow-inner">
                                <div class="h-full bg-slate-700 rounded-full relative" style="width: 0%"></div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-8 pt-6 border-t border-slate-800/80 relative z-10">
                        @if($startup->pitch_deck)
                            <a href="{{ asset('storage/' . $startup->pitch_deck) }}" target="_blank" class="w-full px-6 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-[0_4px_20px_rgba(16,185,129,0.3)] hover:shadow-[0_6px_25px_rgba(16,185,129,0.4)] transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                Download Pitch Deck
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        @else
                            <button disabled class="w-full px-6 py-3.5 bg-slate-800 text-slate-500 font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                No Pitch Deck Available
                            </button>
                        @endif
                    </div>
                </div>
                
                <!-- Founder Information -->
                <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-xl">
                    <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest mb-6">Leadership</h3>
                    <div class="flex items-center gap-5 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-900 to-slate-800 flex items-center justify-center text-2xl font-black text-indigo-400 border-2 border-indigo-900/50 shadow-inner">
                            {{ substr($startup->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-xl text-white">{{ $startup->user->name }}</div>
                            <div class="text-sm font-semibold text-indigo-400">Founder & CEO</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-400 bg-slate-950 p-4 rounded-xl border border-slate-800">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Joined ecosystem {{ $startup->user->created_at->format('M Y') }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-public-layout>
