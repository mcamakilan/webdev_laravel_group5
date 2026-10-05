<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Viewer & Student Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- 1. ATTENDANCE SEARCH SECTION -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-gray-800">Attendance Search</h3>
                    <form method="GET" action="{{ route('attendance') }}" class="flex items-center space-x-4">
                        <div>
                            <input type="text" 
                                   name="student_number" 
                                   value="{{ request('student_number') }}" 
                                   placeholder="Enter Student Number" 
                                   class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm w-64" 
                                   required>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 transition ease-in-out duration-150">
                            VIEW
                        </button>
                    </form>

                    <!-- Search Results -->
                    @if(request('student_number'))
                        <div class="mt-6 border-t pt-4">
                            @if($student)
                                <h4 class="text-md font-bold mb-3 text-teal-700">Student Details</h4>
                                <div class="flex items-center space-x-6 mb-6">
                                    <!-- Student Photo Display -->
                                    @if($student->photo)
                                        <div class="shrink-0">
                                            <img src="{{ asset('storage/' . $student->photo) }}" 
                                                 alt="{{ $student->name }}'s Photo" 
                                                 class="h-28 w-28 object-cover rounded-full border-2 border-teal-500 shadow-md">
                                        </div>
                                    @else
                                        <div class="h-28 w-28 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center text-gray-500 font-semibold text-xs">
                                            No Photo
                                        </div>
                                    @endif

                                    <!-- Student Info Grid -->
                                    <div class="grid grid-cols-2 gap-4 w-full">
                                        <div><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</div>
                                        <div><strong>Student Number:</strong> {{ $student->student_number }}</div>
                                        <div><strong>Mobile Number:</strong> {{ $student->mobile_number }}</div>
                                        <div><strong>Year & Section:</strong> {{ $student->year_and_section }}</div>
                                    </div>
                                </div>

                                <!-- Time In Action & Attendance Log Header -->
                                <div class="flex items-center justify-between mb-4 border-t pt-4">
                                    <h4 class="text-md font-bold text-teal-700">Attendance Log</h4>
                                    
                                    <!-- LOG TIME IN BUTTON -->
                                    <form method="POST" action="{{ route('attendance.check-in') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $student->id }}">
                                        <input type="hidden" name="student_number" value="{{ $student->student_number }}">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 transition ease-in-out duration-150 shadow-sm">
                                            LOG TIME IN
                                        </button>
                                    </form>
                                </div>

                                <!-- Attendance Logs Table / List -->
                                @if($attendances && $attendances->count() > 0)
                                    <ul class="list-disc pl-5 space-y-1 text-gray-700">
                                        @foreach($attendances as $record)
                                            <li>{{ $record->created_at->format('M d, Y - h:i A') }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-500 italic">No attendance records logged yet. Click "LOG TIME IN" to record attendance.</p>
                                @endif
                            @else
                                <p class="text-red-500 font-semibold">Error: No student found matching "<strong>{{ request('student_number') }}</strong>".</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- 2. STUDENT REGISTRATION FORM -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-gray-800">[STUDENT REGISTRATION]</h3>
                    
                    <form method="POST" action="{{ route('attendance.register-student') }}" enctype="multipart/form-data" class="space-y-4 max-w-2xl">
                        @csrf

                        <!-- Student Number -->
                        <div>
                            <x-input-label for="student_number" :value="__('Student Number')" />
                            <x-text-input id="student_number" class="block mt-1 w-full" type="text" name="student_number" :value="old('student_number')" required />
                            <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                        </div>

                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <x-input-label for="mobile_number" :value="__('Mobile Number')" />
                            <x-text-input id="mobile_number" class="block mt-1 w-full" type="text" name="mobile_number" :value="old('mobile_number')" required />
                            <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
                        </div>

                        <!-- Year/Section -->
                        <div>
                            <x-input-label for="year_and_section" :value="__('Year/Section')" />
                            <x-text-input id="year_and_section" class="block mt-1 w-full" type="text" name="year_and_section" :value="old('year_and_section')" required />
                            <x-input-error :messages="$errors->get('year_and_section')" class="mt-2" />
                        </div>

                        <!-- Upload Photo -->
                        <div>
                            <x-input-label for="photo" :value="__('Upload Photo')" />
                            <input id="photo" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2" type="file" name="photo" accept="image/*" required />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                                REGISTER STUDENT
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>