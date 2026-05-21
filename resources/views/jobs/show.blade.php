<x-public-layout>
    <!-- Premium Job Header -->
    <div class="relative bg-slate-950 pt-20 pb-24 overflow-hidden border-b border-slate-900 shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-br from-violet-900/20 via-slate-900/80 to-fuchsia-900/10 pointer-events-none z-0"></div>
        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-violet-500/10 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none z-0"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-white transition-colors mb-8 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                Back to Career Opportunities
            </a>

            <div class="flex flex-col md:flex-row items-start gap-8">
                <!-- Startup Logo -->
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-3xl bg-slate-900 border-2 border-violet-500/30 overflow-hidden shadow-[0_0_30px_rgba(139,92,246,0.2)] flex items-center justify-center shrink-0">
                    @if($job->startup->logo)
                        <img src="{{ asset('storage/' . $job->startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <span class="font-black text-violet-400 text-5xl">{{ substr($job->startup->name, 0, 1) }}</span>
                    @endif
                </div>
                
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="px-3 py-1 rounded-lg bg-violet-500/10 text-violet-400 border border-violet-500/20 font-black text-[10px] uppercase tracking-widest shadow-inner">
                            {{ $job->type }}
                        </span>
                        <span class="px-3 py-1 rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/20 font-black text-[10px] uppercase tracking-widest shadow-inner flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                            Actively Hiring
                        </span>
                    </div>
                    <h1 class="font-heading text-4xl md:text-5xl font-black text-white mb-2 tracking-tight">{{ $job->title }}</h1>
                    <a href="{{ route('marketplace.show', $job->startup) }}" class="text-xl text-slate-400 hover:text-violet-400 transition-colors font-bold inline-flex items-center gap-2">
                        {{ $job->startup->name }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-10 relative z-20" x-data="{ showApply: false }">
        
        <!-- Error Alerts -->
        @if(session('error'))
            <div class="mb-8 p-5 bg-red-950/50 border border-red-500/30 text-red-200 rounded-2xl flex items-center gap-4 shadow-xl">
                <div class="w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center">
                    <svg class="w-4 h-4 flex-shrink-0 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Job Description -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-800 shadow-xl relative overflow-hidden group hover:border-violet-500/30 transition-colors duration-500">
                    <div class="absolute inset-0 bg-gradient-to-b from-violet-900/5 to-transparent pointer-events-none"></div>
                    
                    <!-- Job Highlights Bar -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-slate-400 mb-8 border-b border-slate-800/80 pb-8 relative z-10">
                        @if($job->salary_range)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20">
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Compensation</p>
                                    <p class="font-bold text-white">{{ $job->salary_range }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-fuchsia-500/10 flex items-center justify-center border border-fuchsia-500/20">
                                <svg class="w-5 h-5 text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Location</p>
                                <p class="font-bold text-white">Remote / Global</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Posted</p>
                                <p class="font-bold text-white">{{ $job->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prose prose-invert prose-slate max-w-none relative z-10">
                        <h3 class="text-white text-2xl font-black mb-6 tracking-tight flex items-center gap-2">
                            <svg class="w-6 h-6 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Role Description
                        </h3>
                        <p class="text-slate-300 leading-relaxed whitespace-pre-line text-lg font-medium">{{ $job->description }}</p>
                    </div>

                    <!-- Application Form Expansion -->
                    <div x-show="showApply" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="mt-12 pt-8 border-t border-slate-800 relative z-10" style="display: none;">
                        @auth
                            @if(auth()->user()->role === 'freelancer')
                                <div class="bg-slate-950 p-6 rounded-2xl border border-violet-900/50 shadow-inner">
                                    <h3 class="text-white text-xl font-black mb-6 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        Submit Your Application
                                    </h3>
                                    
                                    <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label for="cover_letter" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Cover Letter / Pitch</label>
                                            <textarea id="cover_letter" name="cover_letter" rows="5" class="w-full bg-slate-900 border border-slate-800 text-white rounded-xl p-4 focus:ring-violet-500 focus:border-violet-500 block text-sm outline-none transition-colors shadow-inner" placeholder="Why are you the perfect fit for this role? What unique value do you bring?"></textarea>
                                        </div>

                                        <div>
                                            <label for="resume" class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Upload Resume (PDF/DOC)</label>
                                            <input type="file" id="resume" name="resume" class="block w-full text-sm text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-violet-900/20 file:text-violet-400 hover:file:bg-violet-900/40 file:transition-colors file:cursor-pointer border border-slate-800 rounded-xl bg-slate-900 shadow-inner">
                                        </div>

                                        <div class="flex items-center gap-4 pt-4 border-t border-slate-800/80">
                                            <button type="submit" class="px-8 py-3.5 bg-violet-600 hover:bg-violet-500 text-white font-bold rounded-xl transition-all shadow-[0_4px_20px_rgba(139,92,246,0.3)] hover:shadow-[0_6px_25px_rgba(139,92,246,0.4)] hover:-translate-y-0.5">
                                                Submit Application
                                            </button>
                                            <button type="button" @click="showApply = false" class="px-8 py-3.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-xl transition-colors border border-slate-700">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="p-6 bg-amber-950/30 border border-amber-900/50 text-amber-200 rounded-2xl flex items-start gap-4">
                                    <svg class="w-6 h-6 shrink-0 mt-0.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    <div>
                                        <h4 class="font-bold mb-1">Access Restricted</h4>
                                        <p class="text-sm opacity-90">Only users registered with the <strong>Freelancer/Talent</strong> role can apply to job openings. Please log in with a talent account to apply.</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="p-8 bg-slate-900 border border-slate-800 text-slate-300 rounded-2xl flex flex-col items-center justify-center text-center shadow-inner">
                                <div class="w-16 h-16 bg-violet-900/20 rounded-full flex items-center justify-center text-violet-400 mb-4 border border-violet-500/20">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-2">Authentication Required</h4>
                                <p class="mb-6 text-slate-400 max-w-sm">Please log in to your talent account to submit your application and resume.</p>
                                <a href="{{ route('login') }}" class="px-8 py-3 bg-white text-slate-900 hover:bg-violet-50 font-black rounded-xl transition-all shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                                    Login to Apply
                                </a>
                             </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Right Column: Action Box -->
            <div class="lg:col-span-1">
                <div class="sticky top-6">
                    <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 shadow-2xl relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-violet-900/10 to-transparent pointer-events-none"></div>
                        
                        <h3 class="text-lg font-black text-white mb-6 relative z-10">Ready to join?</h3>
                        
                        <div class="space-y-4 relative z-10">
                            @if($existingApplication)
                                @if($existingApplication->status === 'rejected')
                                    <button disabled class="w-full px-6 py-4 bg-slate-800 text-slate-500 font-black text-lg rounded-xl cursor-not-allowed border border-slate-700 flex items-center justify-center gap-2">
                                        Application Rejected
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                @elseif($existingApplication->status === 'accepted')
                                    <button disabled class="w-full px-6 py-4 bg-emerald-900/40 text-emerald-400 font-black text-lg rounded-xl cursor-not-allowed border border-emerald-500/30 flex items-center justify-center gap-2 shadow-inner">
                                        Application Accepted
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                @else
                                    <button disabled class="w-full px-6 py-4 bg-amber-900/40 text-amber-400 font-black text-lg rounded-xl cursor-not-allowed border border-amber-500/30 flex items-center justify-center gap-2 shadow-inner">
                                        Application Pending
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                @endif
                            @else
                                <button @click="showApply = true" class="w-full px-6 py-4 bg-violet-600 hover:bg-violet-500 text-white font-black text-lg rounded-xl shadow-[0_4px_20px_rgba(139,92,246,0.3)] hover:shadow-[0_6px_25px_rgba(139,92,246,0.4)] transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                                    Apply Now
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            @endif
                            <button class="w-full px-6 py-4 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-bold rounded-xl transition-all duration-300 border border-slate-700 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                Save for Later
                            </button>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-slate-800 text-center relative z-10">
                            <p class="text-xs font-medium text-slate-500 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Highly responsive startup
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-public-layout>
