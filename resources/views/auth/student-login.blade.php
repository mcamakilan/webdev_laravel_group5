<x-guest-layout>
    <!-- Heading -->
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500
                    flex items-center justify-center shadow-lg shadow-blue-400/30">
            <!-- Academic Cap Icon -->
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v6" />
            </svg>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Student Portal</h1>
        <p class="mt-1 text-sm text-gray-500">Log in to your student account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('student.login.submit') }}" class="space-y-5">
        @csrf

        <!-- Email/Student ID -->
        <div>
            <x-input-label for="email" :value="__('Email or Student ID')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="email"
                class="block mt-1.5 w-full rounded-lg border-gray-200 bg-white/80 text-gray-800 placeholder-gray-400
                       focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-200 transition"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username"
                placeholder="student@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="password"
                class="block mt-1.5 w-full rounded-lg border-gray-200 bg-white/80 text-gray-800 placeholder-gray-400
                       focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-200 transition"
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
                    class="rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-300"
                    name="remember">
                <span class="ms-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-700 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 rounded-md"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full mt-2 inline-flex justify-center items-center px-4 py-2.5 rounded-lg
                   bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600
                   text-white text-sm font-medium tracking-wide
                   shadow-lg shadow-blue-400/30 transition
                   focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
            {{ __('Log in as Student') }}
        </button>
    </form>
    
    <!-- Go Back Link -->
    <div class="mt-6 text-center">
        <a href="{{ route('role.selection') }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
            &larr; Back to login selection
        </a>
    </div>
</x-guest-layout>