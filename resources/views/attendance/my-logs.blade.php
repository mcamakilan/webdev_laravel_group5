<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Attendance Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alert -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Student Summary Header Card & Check-In Action -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">Student No: <span class="font-semibold text-gray-700">{{ Auth::user()->student_number ?? 'N/A' }}</span></p>
                    <p class="text-sm text-gray-500">Program / Year & Section: <span class="font-semibold text-gray-700">{{ Auth::user()->college_program ?? 'N/A' }} — {{ Auth::user()->year_and_section ?? 'N/A' }}</span></p>
                </div>

                <div class="flex items-center space-x-4">
                    <form method="POST" action="{{ route('attendance.student-check-in') }}">
                        @csrf
                        <button type="submit" class="px-5 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg text-xs uppercase tracking-widest shadow-md transition">
                            Check In Now
                        </button>
                    </form>

                    <div class="bg-teal-50 border border-teal-200 px-4 py-2 rounded-lg text-center">
                        <span class="block text-2xl font-extrabold text-teal-600">{{ $attendances->total() }}</span>
                        <span class="text-xs uppercase tracking-wider font-semibold text-teal-800">Total Check-ins</span>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date & Time Logged</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($attendances as $record)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Present
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700 font-medium">
                                    {{ $record->formatted_time }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500 italic">
                                    You have no recorded attendance check-ins yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $attendances->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>