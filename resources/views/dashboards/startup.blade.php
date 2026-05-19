<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Startup Owner Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    <p>{{ __("Welcome! Here you can manage your startup profile, add products, and seek funding.") }}</p>
                    
                    @if(auth()->user()->startup)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-6 bg-gray-900/50 rounded-xl border border-gray-700">
                                <h3 class="text-xl font-bold text-white">{{ auth()->user()->startup->name }}</h3>
                                <p class="text-sm text-cyan-400 mt-1">{{ auth()->user()->startup->stage }} Stage</p>
                                <p class="text-gray-400 mt-3">{{ auth()->user()->startup->description }}</p>
                            </div>
                            
                            <div class="p-6 bg-gray-900/50 rounded-xl border border-gray-700 flex flex-col justify-center items-center text-center">
                                <h3 class="text-lg font-semibold text-white mb-2">Grow Your Team</h3>
                                <p class="text-sm text-gray-400 mb-4">Post a job opening to attract top talent and freelancers.</p>
                                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-6 py-2 bg-gray-800 border border-gray-600 rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                                    Post a Job
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="p-6 bg-cyan-500/10 rounded-xl border border-cyan-500/20 text-center">
                            <h3 class="text-lg font-semibold text-cyan-400 mb-2">You haven't set up your Startup Profile yet.</h3>
                            <p class="text-gray-400 mb-6">Create your profile to start connecting with investors and customers.</p>
                            <a href="{{ route('startups.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-cyan-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                                Create Startup Profile
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
