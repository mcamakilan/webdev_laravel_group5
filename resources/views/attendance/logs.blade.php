<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Attendance Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    
                    <table class="w-full whitespace-nowrap text-left text-sm">
                        <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-4">Date & Time In</th>
                                <th class="px-6 py-4">Student Name</th>
                                <th class="px-6 py-4">Student Number</th>
                                <th class="px-6 py-4">Year & Section</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-teal-700 font-medium">
                                        {{ $log->created_at->format('M d, Y — h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ $log->user ? $log->user->name : 'Unknown Student' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $log->student_number }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $log->user ? $log->user->year_and_section : 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">
                                        No attendance logs recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>