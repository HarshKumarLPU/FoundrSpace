<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Startup Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700">
                <div class="p-8 text-gray-100">
                    <form method="POST" action="{{ route('startups.update', $startup) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Startup Name')" class="text-gray-300" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500" type="text" name="name" :value="old('name', $startup->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="startup_category_id" :value="__('Industry Category')" class="text-gray-300" />
                            <select id="startup_category_id" name="startup_category_id" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('startup_category_id', $startup->startup_category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('startup_category_id')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description / Elevator Pitch')" class="text-gray-300" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm" required>{{ old('description', $startup->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Stage -->
                        <div>
                            <x-input-label for="stage" :value="__('Funding Stage')" class="text-gray-300" />
                            <select id="stage" name="stage" class="block mt-1 w-full bg-gray-900/50 border-gray-700 text-white focus:ring-cyan-500 focus:border-cyan-500 rounded-md shadow-sm" required>
                                <option value="Bootstrapped" {{ (old('stage', $startup->stage) == 'Bootstrapped') ? 'selected' : '' }}>Bootstrapped</option>
                                <option value="Pre-Seed" {{ (old('stage', $startup->stage) == 'Pre-Seed') ? 'selected' : '' }}>Pre-Seed</option>
                                <option value="Seed" {{ (old('stage', $startup->stage) == 'Seed') ? 'selected' : '' }}>Seed</option>
                                <option value="Series A" {{ (old('stage', $startup->stage) == 'Series A') ? 'selected' : '' }}>Series A</option>
                                <option value="Series B+" {{ (old('stage', $startup->stage) == 'Series B+') ? 'selected' : '' }}>Series B or later</option>
                            </select>
                            <x-input-error :messages="$errors->get('stage')" class="mt-2" />
                        </div>

                        <!-- Logo -->
                        <div>
                            <x-input-label for="logo" :value="__('Startup Logo (Max 2MB)')" class="text-gray-300" />
                            <input id="logo" type="file" name="logo" accept="image/*" class="block mt-1 w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20" />
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 400x400px. Max size: 2MB.</p>
                        </div>
                        
                        <!-- Banner -->
                        <div>
                            <x-input-label for="banner" :value="__('Cover Banner (Max 2MB)')" class="text-gray-300" />
                            <input id="banner" type="file" name="banner" accept="image/*" class="block mt-1 w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20" />
                            <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 1200x400px. Max size: 2MB.</p>
                        </div>
                        
                        <!-- Pitch Deck -->
                        <div>
                            <x-input-label for="pitch_deck" :value="__('Pitch Deck (PDF, Max 2MB)')" class="text-gray-300" />
                            <input id="pitch_deck" type="file" name="pitch_deck" accept=".pdf" class="block mt-1 w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-500/10 file:text-emerald-400 hover:file:bg-emerald-500/20" />
                            <x-input-error :messages="$errors->get('pitch_deck')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-2">Optional. Upload your investor pitch deck to showcase your vision (Max 2MB depending on your server limits).</p>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="bg-gradient-to-r from-purple-600 to-cyan-500 border-0 hover:from-purple-500 hover:to-cyan-400 transition-all shadow-[0_0_15px_rgba(6,182,212,0.4)] px-8 py-3 text-base">
                                {{ __('Update Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
