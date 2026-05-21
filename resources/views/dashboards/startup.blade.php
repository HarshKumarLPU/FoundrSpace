<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-200 leading-tight">
            {{ __('Startup Owner Console') }}
        </h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Session Messages -->
        @if(session('success'))
            <div class="p-4 bg-slate-800 border border-slate-700 text-slate-200 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($startup)
            <!-- Profile Cover & Summary -->
            <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
                <div class="h-32 bg-gradient-to-r from-slate-900 to-slate-800 relative"></div>
                <div class="px-8 pb-8 relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-start gap-5 -mt-10">
                        <div class="w-20 h-20 rounded-2xl bg-slate-900 border-4 border-slate-950 overflow-hidden flex items-center justify-center shadow-lg">
                            @if($startup->logo)
                                <img src="{{ asset('storage/' . $startup->logo) }}" alt="Logo" class="w-full h-full object-cover">
                            @else
                                <span class="font-bold text-slate-500 text-3xl">{{ substr($startup->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="mt-12 md:mt-10">
                            <div class="flex items-center gap-3">
                                <h3 class="text-2xl font-extrabold text-white">{{ $startup->name }}</h3>
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded bg-slate-800 text-slate-350 border border-slate-700 uppercase tracking-wide">
                                    {{ $startup->stage }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-400 mt-1">{{ $startup->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                    <div class="md:mt-6 flex items-center gap-3 w-full md:w-auto">
                        <a href="{{ route('jobs.create') }}" class="w-full md:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-slate-100 hover:bg-white text-slate-950 text-sm font-bold rounded-lg border border-slate-200/50 shadow-sm transition-all">
                            Post a Job
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Overview Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Market Products</p>
                    <h4 class="text-3xl font-extrabold text-white mt-2">{{ $products->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Services Listed</p>
                    <h4 class="text-3xl font-extrabold text-white mt-2">{{ $services->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Open Positions</p>
                    <h4 class="text-3xl font-extrabold text-white mt-2">{{ $jobPostings->count() }}</h4>
                </div>
                <div class="glass-panel rounded-2xl p-6 border border-slate-800 shadow-sm text-center">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Job Applications</p>
                    <h4 class="text-3xl font-extrabold text-white mt-2">{{ $applications->count() }}</h4>
                </div>
            </div>

            <!-- Main Details Split Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Columns: Products, Services, Jobs -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Products List -->
                    <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-900/50">
                            <h3 class="font-bold text-white">Products Catalog</h3>
                        </div>
                        @if($products->count() > 0)
                            <div class="divide-y divide-slate-800">
                                @foreach($products as $product)
                                    <div class="p-6 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">{{ $product->title }}</h4>
                                            <p class="text-xs text-slate-500 uppercase mt-0.5 tracking-wider">{{ $product->type }}</p>
                                        </div>
                                        <span class="text-lg font-bold text-white">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-500">
                                No products listed in the marketplace yet.
                            </div>
                        @endif
                    </div>

                    <!-- Services List -->
                    <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-900/50">
                            <h3 class="font-bold text-white">Services Catalog</h3>
                        </div>
                        @if($services->count() > 0)
                            <div class="divide-y divide-slate-800">
                                @foreach($services as $service)
                                    <div class="p-6 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">{{ $service->title }}</h4>
                                            <p class="text-xs text-slate-500 mt-1">Delivery time: {{ $service->delivery_days }} days</p>
                                        </div>
                                        <span class="text-lg font-bold text-white">${{ number_format($service->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-500">
                                No consulting services listed.
                            </div>
                        @endif
                    </div>

                    <!-- Job Postings List -->
                    <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-900/50">
                            <h3 class="font-bold text-white">Active Positions</h3>
                        </div>
                        @if($jobPostings->count() > 0)
                            <div class="divide-y divide-slate-800">
                                @foreach($jobPostings as $job)
                                    <div class="p-6 flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">{{ $job->title }}</h4>
                                            <p class="text-xs text-slate-500 mt-1">Salary: {{ $job->salary_range ?? 'Unspecified' }} &bull; {{ ucfirst($job->type) }}</p>
                                        </div>
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-800 text-slate-300 border border-slate-700">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-500">
                                No active positions posted.
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Right Column: Candidate Applications Tracking -->
                <div class="space-y-8">
                    <div class="glass-panel rounded-2xl border border-slate-800 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-800 bg-slate-900/50">
                            <h3 class="font-bold text-white">Hiring Pipeline</h3>
                            <p class="text-xs text-slate-550 mt-1">Review candidates who applied to your startup openings.</p>
                        </div>
                        @if($applications->count() > 0)
                            <div class="divide-y divide-slate-800">
                                @foreach($applications as $app)
                                    <div class="p-6 space-y-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-white">{{ $app->user->name }}</h4>
                                                <p class="text-xs text-slate-300 font-medium">Role: {{ $app->jobPosting->title }}</p>
                                            </div>
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-slate-800 text-slate-400 border border-slate-700 uppercase">
                                                {{ $app->status }}
                                            </span>
                                        </div>
                                        
                                        <div class="text-sm text-slate-400 line-clamp-2">
                                            {{ $app->cover_letter ?? 'No cover letter provided.' }}
                                        </div>

                                        <div class="flex items-center justify-between text-xs pt-3 mt-3 border-t border-slate-800">
                                            <a href="{{ asset('storage/' . $app->resume) }}" target="_blank" class="text-slate-200 hover:text-white font-semibold inline-flex items-center gap-1">
                                                View Resume
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </a>
                                            
                                            <div class="flex items-center gap-2">
                                                @if($app->status === 'pending')
                                                    <form action="{{ route('applications.accept', $app) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 font-bold rounded border border-cyan-500/20 transition-colors">Accept</button>
                                                    </form>
                                                    <form action="{{ route('applications.reject', $app) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 bg-red-500/10 hover:bg-red-500/20 text-red-400 font-bold rounded border border-red-500/20 transition-colors">Reject</button>
                                                    </form>
                                                @else
                                                    <span class="text-slate-500">{{ $app->created_at->diffForHumans() }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center text-slate-550">
                                No job applications received yet.
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        @else
            <!-- Missing Startup Profile Warning -->
            <div class="p-8 bg-slate-900 rounded-2xl border border-slate-800 text-center space-y-4 max-w-xl mx-auto">
                <div class="w-16 h-16 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center mx-auto border border-slate-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white">Create your Startup Profile</h3>
                <p class="text-slate-400">You must set up your company details to enable product listing, jobs posting, and connecting with investors.</p>
                <div class="pt-2">
                    <a href="{{ route('startups.create') }}" class="inline-flex items-center px-6 py-3 bg-slate-100 hover:bg-white text-slate-950 font-bold border border-slate-200 rounded-lg hover:scale-105 transition-all text-xs uppercase tracking-widest shadow-sm">
                        Build Startup Profile
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
