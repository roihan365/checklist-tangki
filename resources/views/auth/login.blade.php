<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 p-4 bg-amber-50 text-amber-700 rounded-lg" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" placeholder="your@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <x-text-input id="password" class="block w-full pl-10" type="password" name="password" required
                    autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center justify-between">
            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox"
                    class="h-4 w-4 text-amber-500 focus:ring-amber-400 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="text-sm text-amber-600 hover:text-amber-500 font-medium">
                    {{ __('Register') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center bg-amber-600 hover:bg-amber-700 focus:ring-amber-500">
                <i class="fas fa-sign-in-alt mr-2"></i>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Social Login -->
    {{-- <div class="mt-6">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Atau masuk dengan</span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="#"
                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fab fa-google text-red-500 mr-2"></i> Google
            </a>
            <a href="#"
                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook
            </a>
        </div>
    </div> --}}
</x-guest-layout>
