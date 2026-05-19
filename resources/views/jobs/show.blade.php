<x-public-layout>
    <div class="max-w-4xl mx-auto px-6 sm:px-12 py-12">
        <div class="glass-panel p-8 sm:p-12 rounded-3xl border border-gray-800 shadow-2xl relative overflow-hidden">
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
                
                <div class="flex-grow">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4 mb-4">
                        <div>
                            <h1 class="font-heading text-3xl font-bold text-white mb-2">{{ $job->title }}</h1>
                            <a href="{{ route('marketplace.show', $job->startup) }}" class="text-xl text-cyan-400 hover:text-cyan-300 transition-colors font-medium">
                                {{ $job->startup->name }}
                            </a>
                        </div>
                        <button class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-cyan-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)] shrink-0">
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
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
