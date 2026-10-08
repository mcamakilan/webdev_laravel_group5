<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-400/30">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Student Registration</h1>
    </div>

    <form method="POST" action="{{ route('student.register.submit') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-200 focus:border-teal-400 focus:ring-2 focus:ring-teal-200" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-200 focus:border-teal-400 focus:ring-2 focus:ring-teal-200" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password Requirements Tip Banner -->
        <div class="p-3 bg-teal-50 border border-teal-200 rounded-lg text-xs text-teal-800 space-y-1">
            <p class="font-semibold">Password Requirements:</p>
            <p>• Minimum 8 characters long</p>
            <p>• Must include uppercase & lowercase letters, numbers, and special characters (e.g., @, !, _)</p>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-200 focus:border-teal-400 focus:ring-2 focus:ring-teal-200" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-200 focus:border-teal-400 focus:ring-2 focus:ring-teal-200" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <button type="submit" class="w-full mt-4 inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white text-sm font-medium shadow-lg shadow-teal-400/30 transition focus:outline-none focus:ring-2 focus:ring-teal-300 focus:ring-offset-2">
            {{ __('Register as Student') }}
        </button>

        <div class="mt-4 text-center">
            <a class="text-sm text-gray-500 hover:text-teal-600 hover:underline transition" href="{{ route('student.login') }}">
                {{ __('Already registered? Log in') }}
            </a>
        </div>
    </form>
</x-guest-layout>