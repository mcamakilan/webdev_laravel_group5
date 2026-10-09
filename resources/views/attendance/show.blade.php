<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student Details & Attendance Logs') }}
            </h2>
            <a href="{{ route('attendance') }}" class="text-sm text-teal-600 hover:text-teal-800 font-semibold">&larr; Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- STUDENT DETAILS CARD -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center space-x-6">
                    @if($student->photo)
                        <img src="{{ asset('storage/' . $student->photo) }}" alt="Photo" class="h-28 w-28 object-cover rounded-full border-2 border-teal-500 shadow-md">
                    @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 border-2 border-gray-300 flex items-center justify-center text-gray-500 font-semibold text-xs">
                            No Photo
                        </div>
                    @endif

                    <div class="space-y-1">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</h3>
                        <p class="text-sm text-gray-600"><strong>Student Number:</strong> {{ $student->student_number }}</p>
                        <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $student->email }}</p>
                        <p class="text-sm text-gray-600"><strong>Year & Section:</strong> {{ $student->year_and_section }}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('attendance.student.edit', $student->id) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-lg text-xs uppercase tracking-widest shadow-sm transition flex items-center justify-center">
                        Edit Details
                    </a>

                    <form method="POST" action="{{ route('attendance.check-in') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $student->id }}">
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg text-xs uppercase tracking-widest shadow-sm transition">
                            LOG TIME IN
                        </button>
                    </form>
                </div>
            </div>

            <!-- ATTENDANCE LOGS CARD -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h4 class="text-lg font-bold text-teal-700 mb-4">Attendance Logs</h4>
                @if($attendances->count() > 0)
                    <ul class="divide-y divide-gray-100">
                        @foreach($attendances as $record)
                            <li class="py-3 flex justify-between items-center text-sm">
                                <span class="font-medium text-gray-700">Present</span>
                                <span class="text-gray-500">{{ $record->created_at->format('F d, Y — h:i A') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic text-sm">No attendance records logged yet.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>