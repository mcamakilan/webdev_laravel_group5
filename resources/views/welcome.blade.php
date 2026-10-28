<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="antialiased bg-gray-50 text-gray-800">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-teal-500 selection:text-white">
            
            @if (Route::has('role.selection'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-500">Dashboard</a>
                    @else
                        <a href="{{ route('role.selection') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-teal-500">Log in</a>
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <x-application-logo class="w-20 h-20 fill-current text-teal-600" />
                </div>

                <div class="mt-8 text-center">
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Attendance Monitoring System</h1>
                    <p class="mt-3 text-lg text-gray-600">Scan student numbers, manage accounts, and track real-time attendance logs.</p>
                </div>

                <div class="mt-10 flex justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-teal-600 text-white font-bold rounded-lg uppercase tracking-wider text-sm shadow-md hover:bg-teal-700 transition">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('role.selection') }}" class="px-6 py-3 bg-teal-600 text-white font-bold rounded-lg uppercase tracking-wider text-sm shadow-md hover:bg-teal-700 transition">
                            Get Started / Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>