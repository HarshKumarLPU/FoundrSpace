<x-guest-layout>
    <div class="glass-panel p-8 sm:p-10 rounded-[2rem]" x-data="registerForm()">
        <div class="mb-8">
            <h2 class="text-3xl font-black text-white font-heading tracking-tight mb-2">Create an account</h2>
            <p class="text-slate-400 font-medium">Join the ecosystem and start building your future.</p>
        </div>

        <!-- Social Logins -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <button type="button" class="flex justify-center items-center gap-3 w-full px-4 py-3 bg-slate-900 hover:bg-slate-800 border border-slate-700 hover:border-slate-500 rounded-xl text-sm font-bold text-white transition-all shadow-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Google
            </button>
            <button type="button" class="flex justify-center items-center gap-3 w-full px-4 py-3 bg-slate-900 hover:bg-slate-800 border border-slate-700 hover:border-slate-500 rounded-xl text-sm font-bold text-white transition-all shadow-sm">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.379.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
                GitHub
            </button>
        </div>

        <div class="relative flex items-center py-5">
            <div class="flex-grow border-t border-slate-800"></div>
            <span class="flex-shrink-0 mx-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Or sign up with email</span>
            <div class="flex-grow border-t border-slate-800"></div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6 mt-4">
            @csrf
            
            <!-- Hidden Role Input (Controlled by Alpine) -->
            <input type="hidden" name="role" x-model="role">
            <x-input-error :messages="$errors->get('role')" class="mt-1" />

            <!-- Role Selection Cards -->
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">I am joining as a...</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="role = 'startup_owner'" :class="role === 'startup_owner' ? 'bg-indigo-600/20 border-indigo-500 text-indigo-300' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-600'" class="p-4 rounded-xl border text-left transition-all relative overflow-hidden group">
                        <div x-show="role === 'startup_owner'" class="absolute top-2 right-2 text-indigo-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <svg class="w-6 h-6 mb-2" :class="role === 'startup_owner' ? 'text-indigo-400' : 'text-slate-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <div class="font-bold text-sm text-white mb-1">Founder</div>
                        <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Build & Raise</div>
                    </button>

                    <button type="button" @click="role = 'investor'" :class="role === 'investor' ? 'bg-emerald-600/20 border-emerald-500 text-emerald-300' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-600'" class="p-4 rounded-xl border text-left transition-all relative overflow-hidden group">
                        <div x-show="role === 'investor'" class="absolute top-2 right-2 text-emerald-400" style="display: none;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <svg class="w-6 h-6 mb-2" :class="role === 'investor' ? 'text-emerald-400' : 'text-slate-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div class="font-bold text-sm text-white mb-1">Investor</div>
                        <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Back Startups</div>
                    </button>

                    <button type="button" @click="role = 'freelancer'" :class="role === 'freelancer' ? 'bg-violet-600/20 border-violet-500 text-violet-300' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-600'" class="p-4 rounded-xl border text-left transition-all relative overflow-hidden group">
                        <div x-show="role === 'freelancer'" class="absolute top-2 right-2 text-violet-400" style="display: none;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <svg class="w-6 h-6 mb-2" :class="role === 'freelancer' ? 'text-violet-400' : 'text-slate-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <div class="font-bold text-sm text-white mb-1">Talent</div>
                        <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Find Roles</div>
                    </button>
                    
                    <button type="button" @click="role = 'customer'" :class="role === 'customer' ? 'bg-cyan-600/20 border-cyan-500 text-cyan-300' : 'bg-slate-900 border-slate-800 text-slate-400 hover:border-slate-600'" class="p-4 rounded-xl border text-left transition-all relative overflow-hidden group">
                        <div x-show="role === 'customer'" class="absolute top-2 right-2 text-cyan-400" style="display: none;">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <svg class="w-6 h-6 mb-2" :class="role === 'customer' ? 'text-cyan-400' : 'text-slate-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <div class="font-bold text-sm text-white mb-1">Customer</div>
                        <div class="text-[10px] uppercase font-bold tracking-wider opacity-80">Explore Products</div>
                    </button>
                </div>
            </div>

            <!-- Dynamic Name Field -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5" x-text="role === 'startup_owner' ? 'Company or Founder Name' : 'Full Name'"></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="pl-10 block w-full bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:ring-indigo-500 focus:border-indigo-500 py-2.5 transition-colors placeholder-slate-600" placeholder="John Doe">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="pl-10 block w-full bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:ring-indigo-500 focus:border-indigo-500 py-2.5 transition-colors placeholder-slate-600" placeholder="name@company.com">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" @input="updateStrength($event.target.value)" class="pl-10 pr-10 block w-full bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:ring-indigo-500 focus:border-indigo-500 py-2.5 transition-colors placeholder-slate-600" placeholder="••••••••">
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-300 focus:outline-none">
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="showPassword" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
                
                <!-- Password Strength Meter -->
                <div class="mt-2 h-1.5 w-full bg-slate-900 rounded-full overflow-hidden flex gap-1">
                    <div class="h-full flex-1 transition-colors duration-300 rounded-full" :class="passwordStrength >= 1 ? (passwordStrength === 1 ? 'bg-rose-500' : (passwordStrength === 2 ? 'bg-amber-500' : 'bg-emerald-500')) : 'bg-slate-800'"></div>
                    <div class="h-full flex-1 transition-colors duration-300 rounded-full" :class="passwordStrength >= 2 ? (passwordStrength === 2 ? 'bg-amber-500' : 'bg-emerald-500') : 'bg-slate-800'"></div>
                    <div class="h-full flex-1 transition-colors duration-300 rounded-full" :class="passwordStrength >= 3 ? 'bg-emerald-500' : 'bg-slate-800'"></div>
                    <div class="h-full flex-1 transition-colors duration-300 rounded-full" :class="passwordStrength >= 4 ? 'bg-emerald-500' : 'bg-slate-800'"></div>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <input id="password_confirmation" :type="showPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" class="pl-10 pr-10 block w-full bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:ring-indigo-500 focus:border-indigo-500 py-2.5 transition-colors placeholder-slate-600" placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-4 mt-8 pt-4 border-t border-slate-800">
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-500 hover:to-cyan-500 text-white text-sm font-bold rounded-xl shadow-[0_0_20px_rgba(99,102,241,0.3)] hover:shadow-[0_0_25px_rgba(99,102,241,0.5)] transition-all active:scale-95 flex items-center justify-center gap-2 group">
                    Create Account
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>

                <p class="text-center text-sm text-slate-400 font-medium">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-bold transition-colors">Log in</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function registerForm() {
            return {
                role: '{{ old('role', 'startup_owner') }}',
                showPassword: false,
                passwordStrength: 0,
                updateStrength(password) {
                    let strength = 0;
                    if (password.length > 0) strength = 1;
                    if (password.length >= 8) strength = 2;
                    if (password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/[0-9]/)) strength = 3;
                    if (password.length >= 10 && password.match(/[^a-zA-Z0-9]/)) strength = 4;
                    this.passwordStrength = strength;
                }
            }
        }
    </script>
</x-guest-layout>
