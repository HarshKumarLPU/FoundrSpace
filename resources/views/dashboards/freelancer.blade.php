<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Freelancer/Mentor Console') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-4 bg-slate-850 border border-slate-800 text-slate-300 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Banner / Profile -->
        <div class="glass-panel p-8 rounded-2xl border border-slate-800 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h3 class="text-2xl font-extrabold text-white">Welcome back, {{ auth()->user()->name }}!</h3>
                <p class="text-sm text-slate-400 mt-1">Ecosystem Role: Freelancer / Mentor</p>
                <p class="text-slate-400 mt-3 text-sm max-w-2xl">Find project opportunities, full-time roles, and mentor requests from startups looking for your expertise.</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="w-full md:w-auto inline-flex justify-center items-center px-5 py-3 bg-slate-100 hover:bg-white text-slate-950 font-bold text-sm rounded-lg border border-slate-200/50 shadow-sm transition-all">
                Browse Job Board
            </a>
        </div>

        <!-- Application Pipeline Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                <p class="text-xs font-semibold text-slate-550 uppercase tracking-wider">Total Applications</p>
                <h4 class="text-3xl font-extrabold text-white mt-2">{{ $applications->count() }}</h4>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                <p class="text-xs font-semibold text-slate-550 uppercase tracking-wider">Pending Review</p>
                <h4 class="text-3xl font-extrabold text-white mt-2">{{ $applications->where('status', 'pending')->count() }}</h4>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                <p class="text-xs font-semibold text-slate-550 uppercase tracking-wider">Interviews & Offered</p>
                <h4 class="text-3xl font-extrabold text-white mt-2">{{ $applications->whereIn('status', ['interview', 'accepted'])->count() }}</h4>
            </div>
        </div>

        <!-- Applications Tracking List -->
        <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-800 bg-slate-900/50">
                <h3 class="font-bold text-white">Your Submitted Applications</h3>
                <p class="text-xs text-slate-400 mt-1">Track the status of your applications to startup job roles.</p>
            </div>

            @if($applications->count() > 0)
                <div class="divide-y divide-slate-800">
                    @foreach($applications as $app)
                        <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div>
                                <div class="flex items-center gap-3">
                                    <h4 class="font-bold text-white text-lg">{{ $app->jobPosting->title }}</h4>
                                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded bg-slate-850 text-slate-300 border border-slate-800 uppercase tracking-wide">
                                        {{ $app->jobPosting->startup->name }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-2">Applied {{ $app->created_at->diffForHumans() }}</p>
                                @if($app->cover_letter)
                                    <div class="mt-3 p-3 bg-slate-900/40 rounded-lg text-sm text-slate-400 max-w-xl">
                                        <strong class="text-xs text-slate-500 block mb-1">Your Cover Letter:</strong>
                                        {{ $app->cover_letter }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-slate-800 text-slate-300 border border-slate-700 uppercase tracking-wide">
                                    {{ $app->status }}
                                </span>
                                <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-300 hover:text-white">
                                    View Resume
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-12 w-12 text-slate-650 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h.01M12 12h.01M15 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h4 class="text-base font-bold text-slate-300">No applications yet</h4>
                    <p class="text-sm text-slate-500 mt-1 mb-6">Browse open positions posted by startups and submit your first application.</p>
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-800 hover:bg-slate-750 text-white text-sm font-semibold rounded-lg transition-colors border border-slate-700">
                        Explore Job Board
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
