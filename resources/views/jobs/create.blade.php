<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Post a New Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <form method="POST" action="{{ route('jobs.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Job Title')" class="text-gray-300" />
                            <x-text-input id="title" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500" type="text" name="title" :value="old('title')" placeholder="e.g. Senior Frontend Developer" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <!-- Type -->
                        <div>
                            <x-input-label for="type" :value="__('Employment Type')" class="text-gray-300" />
                            <select id="type" name="type" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm" required>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract / Freelance</option>
                                <option value="Internship">Internship</option>
                                <option value="Co-founder">Co-founder / Equity Only</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Salary Range -->
                        <div>
                            <x-input-label for="salary_range" :value="__('Salary / Equity Range (Optional)')" class="text-gray-300" />
                            <x-text-input id="salary_range" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500" type="text" name="salary_range" :value="old('salary_range')" placeholder="e.g. $80k - $120k + 1% Equity" />
                            <x-input-error :messages="$errors->get('salary_range')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Job Description')" class="text-gray-300" />
                            <textarea id="description" name="description" rows="6" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm" required placeholder="Describe the responsibilities, requirements, and benefits...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="bg-gradient-to-r from-purple-600 to-cyan-500 border-0 hover:from-purple-500 hover:to-cyan-400 transition-all shadow-[0_0_15px_rgba(6,182,212,0.4)] px-8 py-3 text-base">
                                {{ __('Post Job') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
