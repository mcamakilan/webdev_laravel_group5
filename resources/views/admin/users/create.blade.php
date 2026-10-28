<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New User Account') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-teal-600 hover:text-teal-800 font-semibold">&larr; Back to Users</a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ role: 'student' }">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="role" :value="__('Account Type / Role')" />
                        <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm">
                            <option value="student">Student Account</option>
                            <option value="admin">Admin Account</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
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

                    <div>
                        <x-input-label for="email" :value="__('Email Address')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Student Specific Fields -->
                    <div x-show="role === 'student'" class="space-y-4">
                        <div>
                            <x-input-label for="student_number" :value="__('Student Number')" />
                            <x-text-input id="student_number" class="block mt-1 w-full" type="text" name="student_number" :value="old('student_number')" />
                            <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="college_program" :value="__('College Program')" />
                                <x-text-input id="college_program" class="block mt-1 w-full" type="text" name="college_program" :value="old('college_program')" placeholder="e.g. BSIT" />
                                <x-input-error :messages="$errors->get('college_program')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="year_and_section" :value="__('Year & Section')" />
                                <x-text-input id="year_and_section" class="block mt-1 w-full" type="text" name="year_and_section" :value="old('year_and_section')" placeholder="e.g. 3A" />
                                <x-input-error :messages="$errors->get('year_and_section')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg text-xs text-blue-800">
                        <p class="font-semibold">Automated Password Generation Enabled:</p>
                        <p>Passwords will be generated automatically and displayed on the success banner upon submission.</p>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-widest rounded-lg">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white font-bold text-xs uppercase tracking-widest rounded-lg">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>