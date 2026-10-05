<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome card -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-teal-500 to-cyan-600 shadow-lg shadow-teal-400/20 p-8">
                <!-- decorative circles -->
                <div class="pointer-events-none absolute -top-10 -right-10 w-40 h-40 rounded-full bg-white/10"></div>
                <div class="pointer-events-none absolute bottom-0 right-24 w-24 h-24 rounded-full bg-white/10"></div>
                <div class="pointer-events-none absolute -bottom-8 left-1/3 w-28 h-28 rounded-full bg-white/5"></div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-semibold text-white tracking-tight">
                        {{ __('Welcome back') }}{{ Auth::user() ? ', ' . Auth::user()->name : '' }} 👋
                    </h3>
                    <p class="mt-1.5 text-teal-50/90 text-sm">
                        {{ __("You're logged in and everything looks good.") }}
                    </p>
                </div>
            </div>

            <!-- Content card -->
            <div class="rounded-2xl border border-teal-100 bg-white/80 backdrop-blur-sm shadow-sm overflow-hidden">
                <div class="p-6 text-gray-700">
                    {{ __("This is your dashboard. Content goes here.") }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>