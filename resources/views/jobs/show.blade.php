<x-public-layout>
    <div class="max-w-4xl mx-auto px-6 sm:px-12 py-12">
        
        <!-- Error Alerts -->
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div x-data="{ showApply: false }" class="glass-panel p-8 sm:p-12 rounded-3xl border border-gray-800 shadow-2xl relative overflow-hidden">
            <!-- Decorative gradient -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
                <!-- Startup Logo -->
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-2xl bg-gray-900 border border-gray-800 flex-shrink-0 overflow-hidden flex items-center justify-center shadow-lg">
                    @if($job->startup->logo)
                        <img src="{{ asset('storage/' . $job->startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <span class="font-bold text-gray-500 text-4xl">{{ substr($job->startup->name, 0, 1) }}</span>
                    @endif
                </div>
                
                <div class="flex-grow w-full">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-4">
                        <div>
                            <h1 class="font-heading text-3xl font-bold text-white mb-2">{{ $job->title }}</h1>
                            <a href="{{ route('marketplace.show', $job->startup) }}" class="text-xl text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
                                {{ $job->startup->name }}
                            </a>
                        </div>
                        <button @click="showApply = !showApply" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-cyan-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)] shrink-0">
                            Apply Now
                        </button>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-400 mb-8 border-b border-gray-800 pb-8">
                        <span class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                {{ $job->type }}
                            </span>
                        </span>
                        @if($job->salary_range)
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $job->salary_range }}
                            </span>
                        @endif
                        <span class="flex items-center gap-2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Posted {{ $job->created_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <div class="prose prose-invert prose-cyan max-w-none">
                        <h3 class="text-white text-xl font-bold mb-4">Job Description</h3>
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line mb-8">{{ $job->description }}</p>
                    </div>

                    <!-- Apply Form Section -->
                    <div x-show="showApply" x-transition class="mt-8 pt-8 border-t border-gray-800">
                        @auth
                            @if(auth()->user()->role === 'freelancer')
                                <h3 class="text-white text-xl font-bold mb-4">Submit Your Application</h3>
                                
                                <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    @csrf
                                    <div>
                                        <label for="cover_letter" class="block text-sm font-medium text-gray-300 mb-2">Cover Letter</label>
                                        <textarea id="cover_letter" name="cover_letter" rows="4" class="w-full bg-gray-900 border border-gray-700 text-white rounded-xl p-3 focus:ring-cyan-500 focus:border-cyan-500 block text-sm" placeholder="Why are you a good fit for this role?"></textarea>
                                    </div>

                                    <div>
                                        <label for="resume" class="block text-sm font-medium text-gray-300 mb-2">Upload Resume (PDF, DOC, DOCX - Optional)</label>
                                        <input type="file" id="resume" name="resume" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20">
                                    </div>

                                    <div class="flex items-center gap-4 pt-2">
                                        <button type="submit" class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white font-semibold rounded-xl transition-colors">
                                            Submit Application
                                        </button>
                                        <button type="button" @click="showApply = false" class="px-6 py-2.5 bg-gray-800 hover:bg-gray-700 text-gray-400 font-semibold rounded-xl transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="p-4 bg-amber-500/10 border border-amber-500/20 text-amber-400 rounded-xl text-sm">
                                    Only users registered with the <strong>Freelancer/Mentor</strong> role can apply to job openings.
                                </div>
                            @endif
                        @else
                            <div class="p-4 bg-amber-500/10 border border-amber-500/20 text-amber-400 rounded-xl text-sm flex items-center justify-between">
                                <span>Please log in to apply for this job position.</span>
                                <a href="{{ route('login') }}" class="text-cyan-400 hover:underline font-bold">Login &rarr;</a>
                             </div>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-public-layout>
