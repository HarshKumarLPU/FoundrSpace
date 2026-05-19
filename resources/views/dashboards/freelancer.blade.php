<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Freelancer/Mentor Console') }}
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

            <!-- Banner / Profile -->
            <div class="bg-gradient-to-r from-purple-900/40 to-cyan-900/40 p-8 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-cyan-400 mt-1">Ecosystem Role: Freelancer / Mentor</p>
                    <p class="text-gray-400 mt-3 text-sm max-w-2xl">Find project opportunities, full-time roles, and mentor requests from startups looking for your expertise.</p>
                </div>
                <a href="{{ route('jobs.index') }}" class="w-full md:w-auto inline-flex justify-center items-center px-5 py-3 bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-semibold rounded-lg transition-colors shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                    Browse Job Board
                </a>
            </div>

            <!-- Application Pipeline Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Applications</p>
                    <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $applications->count() }}</h4>
                </div>
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pending Review</p>
                    <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $applications->where('status', 'pending')->count() }}</h4>
                </div>
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Interviews & Offered</p>
                    <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $applications->whereIn('status', ['interview', 'accepted'])->count() }}</h4>
                </div>
            </div>

            <!-- Applications Tracking List -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                    <h3 class="font-bold text-gray-900 dark:text-white">Your Submitted Applications</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Track the status of your applications to startup job roles.</p>
                </div>

                @if($applications->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($applications as $app)
                            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $app->jobPosting->title }}</h4>
                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 uppercase tracking-wide">
                                            {{ $app->jobPosting->startup->name }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-2">Applied {{ $app->created_at->diffForHumans() }}</p>
                                    @if($app->cover_letter)
                                        <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-800/40 rounded-lg text-sm text-gray-600 dark:text-gray-400 max-w-xl">
                                            <strong class="text-xs text-gray-400 dark:text-gray-500 block mb-1">Your Cover Letter:</strong>
                                            {{ $app->cover_letter }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4 w-full md:w-auto justify-between md:justify-end">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wide">
                                        {{ $app->status }}
                                    </span>
                                    <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-400 hover:text-cyan-300">
                                        View Resume
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h.01M12 12h.01M15 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white">No applications yet</h4>
                        <p class="text-sm text-gray-500 mt-1 mb-6">Browse open positions posted by startups and submit your first application.</p>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-800 hover:bg-gray-700 text-white text-sm font-semibold rounded-lg transition-colors border border-gray-700">
                            Explore Job Board
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
