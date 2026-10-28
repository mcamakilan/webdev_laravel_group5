<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Student Details') }}
            </h2>
            <a href="{{ route('attendance.show', ['student_number' => $student->student_number]) }}" class="text-sm text-teal-600 hover:text-teal-800 font-semibold">&larr; Back to Details</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <form method="POST" action="{{ route('attendance.student.update', $student->id) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="student_number" :value="__('Student Number')" />
                        <x-text-input id="student_number" class="block mt-1 w-full" type="text" name="student_number" :value="old('student_number', $student->student_number)" required />
                        <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $student->first_name)" required />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $student->last_name)" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $student->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="college_program" :value="__('College Program')" />
                            <x-text-input id="college_program" class="block mt-1 w-full" type="text" name="college_program" :value="old('college_program', $student->college_program)" required />
                            <x-input-error :messages="$errors->get('college_program')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="year_and_section" :value="__('Year & Section')" />
                            <x-text-input id="year_and_section" class="block mt-1 w-full" type="text" name="year_and_section" :value="old('year_and_section', $student->year_and_section)" required />
                            <x-input-error :messages="$errors->get('year_and_section')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="photo" :value="__('Update Photo')" />
                        <input id="photo" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2" type="file" name="photo" accept="image/*" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('attendance.show', ['student_number' => $student->student_number]) }}" class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-widest rounded-lg">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white font-bold text-xs uppercase tracking-widest rounded-lg">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>