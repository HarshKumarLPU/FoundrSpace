<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Moderation Dashboard') }}
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

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card: Users -->
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Ecosystem Users</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['total_users'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>

                <!-- Stat Card: Startups -->
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Startups</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['total_startups'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>

                <!-- Stat Card: Investors -->
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Investors</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['total_investors'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 text-green-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <!-- Stat Card: Jobs -->
                <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Career Postings</p>
                        <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1">{{ $stats['total_jobs'] }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Moderation Queue -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900/50">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Startup Profile Approvals Queue</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Approve or reject newly created startup profiles before they become public.</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                        {{ $pendingStartups->count() }} Pending
                    </span>
                </div>

                @if($pendingStartups->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($pendingStartups as $startup)
                            <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                                <div class="flex items-center gap-4">
                                    <!-- Logo placeholder or uploaded -->
                                    <div class="w-14 h-14 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700 overflow-hidden flex-shrink-0">
                                        @if($startup->logo)
                                            <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                        @else
                                            <span class="font-bold text-gray-400 dark:text-gray-500 text-lg">{{ substr($startup->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-bold text-gray-900 dark:text-white text-lg">{{ $startup->name }}</h4>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-purple-500/10 text-purple-400 border border-purple-500/20 uppercase tracking-wide">
                                                {{ $startup->stage }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 max-w-xl">{{ $startup->description }}</p>
                                        <div class="flex items-center gap-4 text-xs text-gray-400 mt-2">
                                            <span>Owner: <strong class="text-gray-600 dark:text-gray-300">{{ $startup->user->name }}</strong></span>
                                            <span>&bull;</span>
                                            <span>Category: <strong class="text-gray-600 dark:text-gray-300">{{ $startup->category->name ?? 'Uncategorized' }}</strong></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-3 w-full md:w-auto">
                                    <form action="{{ route('admin.startups.approve', $startup) }}" method="POST" class="flex-grow md:flex-grow-0">
                                        @csrf
                                        <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-semibold rounded-lg transition-colors">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.startups.reject', $startup) }}" method="POST" class="flex-grow md:flex-grow-0">
                                        @csrf
                                        <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-semibold rounded-lg transition-colors">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h4 class="text-base font-bold text-gray-900 dark:text-white">All caught up!</h4>
                        <p class="text-sm text-gray-500 mt-1">There are no pending startups awaiting approval.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
