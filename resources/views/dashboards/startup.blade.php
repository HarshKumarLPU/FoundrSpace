<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Startup Owner Console') }}
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

            @if($startup)
                <!-- Profile Cover & Summary -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="h-40 bg-gradient-to-r from-purple-900/40 to-cyan-900/40 relative">
                        <!-- Cover overlay/details if needed -->
                    </div>
                    <div class="px-8 pb-8 relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div class="flex items-start gap-5 -mt-10">
                            <div class="w-20 h-20 rounded-2xl bg-gray-900 border-4 border-white dark:border-gray-900 overflow-hidden flex items-center justify-center shadow-lg">
                                @if($startup->logo)
                                    <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                                @else
                                    <span class="font-bold text-gray-500 text-3xl">{{ substr($startup->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="mt-12 md:mt-10">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ $startup->name }}</h3>
                                    <span class="px-2.5 py-0.5 text-xs font-semibold rounded bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 uppercase tracking-wide">
                                        {{ $startup->stage }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $startup->category->name ?? 'Uncategorized' }}</p>
                            </div>
                        </div>
                        <div class="md:mt-6 flex items-center gap-3 w-full md:w-auto">
                            <a href="{{ route('jobs.create') }}" class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-semibold rounded-lg transition-colors shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                                Post a Job
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Overview Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Market Products</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $products->count() }}</h4>
                    </div>
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Services Listed</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $services->count() }}</h4>
                    </div>
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Open Positions</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $jobPostings->count() }}</h4>
                    </div>
                    <div class="bg-white dark:bg-gray-900/50 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm text-center">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Job Applications</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 dark:text-white mt-2">{{ $applications->count() }}</h4>
                    </div>
                </div>

                <!-- Main Details Split Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Columns: Products, Services, Jobs -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Products List -->
                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900/50">
                                <h3 class="font-bold text-gray-900 dark:text-white">Products Catalog</h3>
                            </div>
                            @if($products->count() > 0)
                                <div class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($products as $product)
                                        <div class="p-6 flex justify-between items-center">
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white">{{ $product->title }}</h4>
                                                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase mt-0.5 tracking-wider">{{ $product->type }}</p>
                                            </div>
                                            <span class="text-lg font-bold text-cyan-400">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    No products listed in the marketplace yet.
                                </div>
                            @endif
                        </div>

                        <!-- Services List -->
                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900/50">
                                <h3 class="font-bold text-gray-900 dark:text-white">Services Catalog</h3>
                            </div>
                            @if($services->count() > 0)
                                <div class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($services as $service)
                                        <div class="p-6 flex justify-between items-center">
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white">{{ $service->title }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Delivery time: {{ $service->delivery_days }} days</p>
                                            </div>
                                            <span class="text-lg font-bold text-cyan-400">${{ number_format($service->price, 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    No consulting services listed.
                                </div>
                            @endif
                        </div>

                        <!-- Job Postings List -->
                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900/50">
                                <h3 class="font-bold text-gray-900 dark:text-white">Active Positions</h3>
                            </div>
                            @if($jobPostings->count() > 0)
                                <div class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($jobPostings as $job)
                                        <div class="p-6 flex justify-between items-center">
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white">{{ $job->title }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Salary: {{ $job->salary_range ?? 'Unspecified' }} &bull; {{ ucfirst($job->type) }}</p>
                                            </div>
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-500/10 text-green-400 border border-green-500/20">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    No active positions posted.
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Right Column: Candidate Applications Tracking -->
                    <div class="space-y-8">
                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                                <h3 class="font-bold text-gray-900 dark:text-white">Hiring Pipeline</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Review candidates who applied to your startup openings.</p>
                            </div>
                            @if($applications->count() > 0)
                                <div class="divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($applications as $app)
                                        <div class="p-6 space-y-3">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $app->user->name }}</h4>
                                                    <p class="text-xs text-cyan-400 font-medium">Role: {{ $app->jobPosting->title }}</p>
                                                </div>
                                                <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase">
                                                    {{ $app->status }}
                                                </span>
                                            </div>
                                            
                                            <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                                {{ $app->cover_letter ?? 'No cover letter provided.' }}
                                            </div>

                                            <div class="flex items-center justify-between text-xs pt-1">
                                                <span class="text-gray-400">{{ $app->created_at->diffForHumans() }}</span>
                                                <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="text-cyan-400 hover:text-cyan-300 font-semibold inline-flex items-center gap-1">
                                                    View Resume
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    No job applications received yet.
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            @else
                <!-- Missing Startup Profile Warning -->
                <div class="p-8 bg-cyan-500/10 rounded-2xl border border-cyan-500/20 text-center space-y-4 max-w-xl mx-auto">
                    <div class="w-16 h-16 rounded-full bg-cyan-500/20 text-cyan-400 flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">Create your Startup Profile</h3>
                    <p class="text-gray-400">You must set up your company details to enable product listing, jobs posting, and connecting with investors.</p>
                    <div class="pt-2">
                        <a href="{{ route('startups.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-cyan-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                            Build Startup Profile
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
