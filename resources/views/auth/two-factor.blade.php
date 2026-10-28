<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-teal-400/30">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Two-Factor Authentication</h1>
        <p class="mt-1 text-sm text-gray-500">Enter the 6-digit code sent to your account</p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 bg-teal-50 border border-teal-200 rounded-lg text-xs font-semibold text-teal-800 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('2fa.store') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="two_factor_code" :value="__('Verification Code')" class="text-gray-600 text-sm font-medium" />
            <x-text-input id="two_factor_code"
                class="block mt-1.5 w-full text-center text-2xl font-mono tracking-widest rounded-lg border-gray-200 bg-white/80 text-gray-800 placeholder-gray-400 focus:border-teal-400 focus:ring-2 focus:ring-teal-200 transition"
                type="text"
                name="two_factor_code"
                maxlength="6"
                required autofocus placeholder="123456" />
            <x-input-error :messages="$errors->get('two_factor_code')" class="mt-1.5" />
        </div>

        <button type="submit" class="w-full mt-2 inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white text-sm font-medium shadow-lg shadow-teal-400/30 transition focus:outline-none focus:ring-2 focus:ring-teal-300 focus:ring-offset-2">
            Verify & Continue
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('role.selection') }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
            &larr; Back to login selection
        </a>
    </div>
</x-guest-layout>