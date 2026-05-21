<x-public-layout>
    <div class="max-w-5xl mx-auto py-4">
        <!-- Header & Search -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
            <div>
                <h1 class="font-heading text-4xl font-bold text-white mb-2">Startup Jobs Board</h1>
                <p class="text-slate-400">Join a high-growth startup and build the future.</p>
            </div>
            
            <form action="{{ route('jobs.index') }}" method="GET" class="w-full md:w-auto">
                <input type="text" name="search" placeholder="Search jobs..." value="{{ request('search') }}" class="bg-slate-900 border border-slate-800 text-slate-300 text-sm rounded-lg focus:ring-slate-700 focus:border-slate-700 block w-full md:w-64 p-2.5 outline-none transition-colors">
            </form>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($jobs->count() > 0)
            <div class="space-y-4">
                @foreach($jobs as $job)
                    <a href="{{ route('jobs.show', $job) }}" class="block group glass-panel rounded-xl p-6 border border-slate-800 hover:border-slate-700 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                            <!-- Startup Logo -->
                            <div class="w-16 h-16 rounded-xl bg-slate-900 border border-slate-800 flex-shrink-0 overflow-hidden flex items-center justify-center">
                                @if($job->startup->logo)
                                    <img src="{{ asset('storage/' . $job->startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-slate-500 text-xl">{{ substr($job->startup->name, 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <!-- Job Details -->
                            <div class="flex-grow">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-2">
                                    <div>
                                        <h3 class="font-heading font-bold text-xl text-white group-hover:text-violet-400 transition-colors">{{ $job->title }}</h3>
                                        <p class="text-slate-400 font-medium mt-0.5 text-sm">{{ $job->startup->name }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase bg-violet-900/30 text-violet-400 border border-violet-800/50">
                                        {{ $job->type }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mt-3">
                                    @if($job->salary_range)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $job->salary_range }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-slate-550" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $job->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        @else
            <div class="text-center py-20 glass-panel rounded-2xl border border-slate-800">
                <svg class="mx-auto h-12 w-12 text-slate-650 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-medium text-slate-300">No jobs posted yet</h3>
                <p class="mt-1 text-slate-550">Check back later for exciting opportunities.</p>
            </div>
        @endif
    </div>
</x-public-layout>
