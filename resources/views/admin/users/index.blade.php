<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Account Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg text-xs uppercase tracking-widest shadow-md transition">
                + Add New User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Role Filter Tabs -->
            <div class="flex space-x-2 border-b border-gray-200 pb-2">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg font-semibold text-sm {{ !request('role') ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                    All Users
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'student']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm {{ request('role') === 'student' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                    Students Only
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="px-4 py-2 rounded-lg font-semibold text-sm {{ request('role') === 'admin' ? 'bg-teal-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                    Admins Only
                </a>
            </div>

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-200 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Student No.</th>
                            <th class="px-6 py-4">Program / Year</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            Student
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-800">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->student_number ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $user->college_program ? $user->college_program . ' — ' . $user->year_and_section : '—' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($user->id !== Auth::id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete account: {{ $user->name }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase tracking-wider bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs italic text-gray-400">Current User</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                                    No user accounts found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>