<x-guest-layout>
    <!-- Heading -->
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500
                    flex items-center justify-center shadow-lg shadow-teal-400/30">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-3.5 7.14" />
            </svg>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Admin Portal</h1>
        <p class="mt-1 text-sm text-gray-500">Log in to continue</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="email"
                class="block mt-1.5 w-full rounded-lg border-gray-200 bg-white/80 text-gray-800 placeholder-gray-400
                       focus:border-teal-400 focus:bg-white focus:ring-2 focus:ring-teal-200 transition"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username"
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="password"
                class="block mt-1.5 w-full rounded-lg border-gray-200 bg-white/80 text-gray-800 placeholder-gray-400
                       focus:border-teal-400 focus:bg-white focus:ring-2 focus:ring-teal-200 transition"
                type="password"
                name="password"
                required autocomplete="current-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-teal-500 shadow-sm focus:ring-teal-300"
                    name="remember">
                <span class="ms-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-teal-600 hover:text-teal-700 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-300 rounded-md"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full mt-2 inline-flex justify-center items-center px-4 py-2.5 rounded-lg
                   bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600
                   text-white text-sm font-medium tracking-wide
                   shadow-lg shadow-teal-400/30 transition
                   focus:outline-none focus:ring-2 focus:ring-teal-300 focus:ring-offset-2">
            {{ __('Log in') }}
        </button>
    </form>
</x-guest-layout>