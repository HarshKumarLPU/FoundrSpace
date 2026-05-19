<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Create Investor Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <form method="POST" action="{{ route('investors.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Organization -->
                        <div>
                            <x-input-label for="organization" :value="__('Organization / Fund Name')" class="text-gray-300" />
                            <x-text-input id="organization" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500" type="text" name="organization" :value="old('organization')" placeholder="e.g. Sequoia Capital (Optional)" autofocus />
                            <x-input-error :messages="$errors->get('organization')" class="mt-2" />
                        </div>

                        <!-- Investment Range -->
                        <div>
                            <x-input-label for="investment_range" :value="__('Typical Investment Range')" class="text-gray-300" />
                            <select id="investment_range" name="investment_range" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm">
                                <option value="$10k - $50k (Angel)">$10k - $50k (Angel)</option>
                                <option value="$50k - $250k (Pre-Seed)">$50k - $250k (Pre-Seed)</option>
                                <option value="$250k - $1M (Seed)">$250k - $1M (Seed)</option>
                                <option value="$1M+ (Series A+)">$1M+ (Series A+)</option>
                            </select>
                            <x-input-error :messages="$errors->get('investment_range')" class="mt-2" />
                        </div>

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" :value="__('Investor Bio / Thesis')" class="text-gray-300" />
                            <textarea id="bio" name="bio" rows="4" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm" placeholder="Tell startups what kind of industries and teams you look for...">{{ old('bio') }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="bg-gradient-to-r from-purple-600 to-cyan-500 border-0 hover:from-purple-500 hover:to-cyan-400 transition-all shadow-[0_0_15px_rgba(6,182,212,0.4)] px-8 py-3 text-base">
                                {{ __('Create Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
