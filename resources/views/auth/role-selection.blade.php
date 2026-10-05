<x-guest-layout>
    <!-- Heading -->
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Select Login Type</h1>
        <p class="mt-1 text-sm text-gray-500">Choose your role to continue</p>
    </div>

    <div class="space-y-4">
        <!-- Admin Login Button -->
        <a href="{{ route('login') }}" 
           class="flex items-center p-4 w-full rounded-xl border border-gray-200 bg-white/80 hover:bg-white hover:border-teal-400 hover:shadow-lg hover:shadow-teal-400/20 transition duration-200 group cursor-pointer">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-teal-400/30 group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-3.5 7.14" />
                </svg>
            </div>
            <div class="ml-4 text-left">
                <h2 class="text-lg font-medium text-gray-800 group-hover:text-teal-600 transition">Login as Admin</h2>
                <p class="text-sm text-gray-500">Access the administrator dashboard</p>
            </div>
            <div class="ml-auto text-gray-400 group-hover:text-teal-500 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </div>
        </a>

        <!-- Student Login Button -->
        <a href="{{ route('student.login') }}" 
           class="flex items-center p-4 w-full rounded-xl border border-gray-200 bg-white/80 hover:bg-white hover:border-blue-400 hover:shadow-lg hover:shadow-blue-400/20 transition duration-200 group cursor-pointer">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-blue-400/30 group-hover:scale-105 transition-transform">
                <!-- Academic Cap Icon -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v6" />
                </svg>
            </div>
            <div class="ml-4 text-left">
                <h2 class="text-lg font-medium text-gray-800 group-hover:text-blue-600 transition">Login as Student</h2>
                <p class="text-sm text-gray-500">Access the student learning portal</p>
            </div>
            <div class="ml-auto text-gray-400 group-hover:text-blue-500 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </div>
        </a>
    </div>

    <!-- Registration Link -->
    <div class="mt-6 text-center">
        <a href="{{ route('register.selection') }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
            Don't have an account? Register
        </a>
    </div>
</x-guest-layout>