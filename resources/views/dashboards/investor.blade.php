<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Investor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
                    <p>{{ __("Welcome! Review pitch decks and find the next unicorn startup here.") }}</p>
                    
                    @if(auth()->user()->investor)
                        <div class="p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                            <h3 class="text-xl font-bold text-white">{{ auth()->user()->investor->organization ?? 'Independent Investor' }}</h3>
                            <p class="text-sm text-cyan-400 mt-1">Focus: {{ auth()->user()->investor->investment_range ?? 'Not specified' }}</p>
                            <p class="text-gray-400 mt-3">{{ auth()->user()->investor->bio }}</p>
                        </div>
                    @else
                        <div class="p-6 bg-cyan-500/10 rounded-xl border border-cyan-500/20 text-center">
                            <h3 class="text-lg font-semibold text-cyan-400 mb-2">You haven't set up your Investor Profile yet.</h3>
                            <p class="text-gray-400 mb-6">Create your profile to get access to startup pitch decks and exclusive deals.</p>
                            <a href="{{ route('investors.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-cyan-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 transition-transform shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                                Create Investor Profile
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
