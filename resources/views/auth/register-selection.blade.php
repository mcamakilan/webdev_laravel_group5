<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Select Account Type</h1>
        <p class="mt-1 text-sm text-gray-500">Choose your role to register</p>
    </div>

    <div class="space-y-4">
        <!-- Admin Register Button -->
        <a href="{{ route('register') }}" 
           class="flex items-center p-4 w-full rounded-xl border border-gray-200 bg-white/80 hover:bg-white hover:border-teal-400 hover:shadow-lg hover:shadow-teal-400/20 transition duration-200 group cursor-pointer">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-teal-400/30 group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            </div>
            <div class="ml-4 text-left">
                <h2 class="text-lg font-medium text-gray-800 group-hover:text-teal-600 transition">Register as Admin</h2>
                <p class="text-sm text-gray-500">Create an administrator account</p>
            </div>
            <div class="ml-auto text-gray-400 group-hover:text-teal-500 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </div>
        </a>

        <!-- Student Register Button -->
        <a href="{{ route('student.register') }}" 
           class="flex items-center p-4 w-full rounded-xl border border-gray-200 bg-white/80 hover:bg-white hover:border-blue-400 hover:shadow-lg hover:shadow-blue-400/20 transition duration-200 group cursor-pointer">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white shadow-md shadow-blue-400/30 group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v6" /></svg>
            </div>
            <div class="ml-4 text-left">
                <h2 class="text-lg font-medium text-gray-800 group-hover:text-blue-600 transition">Register as Student</h2>
                <p class="text-sm text-gray-500">Create a student learning account</p>
            </div>
            <div class="ml-auto text-gray-400 group-hover:text-blue-500 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </div>
        </a>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('role.selection') }}" class="text-sm text-gray-500 hover:text-gray-700 hover:underline transition">
            Already have an account? Log in
        </a>
    </div>
</x-guest-layout>