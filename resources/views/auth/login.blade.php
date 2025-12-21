<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Email Address') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input id="email" class="pl-10 block w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 transition duration-200 py-2.5" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="email@sekolah.sch.id" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Password') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input id="password" class="pl-10 block w-full rounded-lg border border-gray-300 bg-gray-50 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 transition duration-200 py-2.5"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-xs text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="underline text-xs text-green-600 hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-lg shadow-lg text-sm font-bold text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 transition-all transform hover:-translate-y-0.5 tracking-wide">
                {{ __('MASUK KE PORTAL') }} <i class="fas fa-arrow-right ml-2 mt-1"></i>
            </button>
        </div>
        
        <div class="pt-4 text-center">
            <a href="{{ url('/') }}" class="text-xs text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-chevron-left mr-1"></i> Kembali ke Halaman Depan
            </a>
        </div>
    </form>
</x-guest-layout>
