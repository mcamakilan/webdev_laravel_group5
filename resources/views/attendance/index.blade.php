<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Monitor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm" role="alert">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative shadow-sm" role="alert">
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl p-10 flex flex-col items-center justify-center space-y-12">
                
                <!-- 1. VIEW / SCAN SECTION -->
                <div class="w-full max-w-sm text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Monitor Attendance</h3>
                    <p class="text-sm text-gray-500 mb-6">Enter or scan a student number below.</p>
                    
                    <form method="GET" action="{{ route('attendance.show') }}" class="flex flex-col space-y-4">
                        <input type="text" 
                               name="student_number" 
                               placeholder="Scan Student Number..." 
                               class="px-4 py-3 w-full border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-lg shadow-sm text-center text-lg font-semibold tracking-widest" 
                               autofocus 
                               required>
                        
                        <button type="submit" class="w-full px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg uppercase tracking-widest transition ease-in-out duration-150 shadow-md">
                            VIEW
                        </button>
                    </form>
                </div>

                <!-- Divider -->
                <div class="w-full max-w-sm border-t border-gray-200"></div>

                <!-- 2. REGISTER SECTION -->
                <div class="w-full max-w-sm text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">New Student?</h3>
                    <p class="text-sm text-gray-500 mb-6">Register a new student to generate their profile.</p>
                    
                    <a href="{{ route('attendance.register') }}" class="inline-flex justify-center w-full px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-bold rounded-lg uppercase tracking-widest transition ease-in-out duration-150 shadow-md">
                        REGISTER
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>