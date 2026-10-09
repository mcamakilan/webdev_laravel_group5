<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AttendanceController extends Controller
{
    /**
     * Main Attendance Dashboard (View & Register Buttons)
     */
    public function index()
    {
        return view('attendance.index');
    }

    /**
     * View/Scan Student Profile & Attendance Logs
     */
    public function show(Request $request)
    {
        $studentNumber = $request->query('student_number', $request->input('student_number'));

        if (! $studentNumber) {
            return redirect()->route('attendance')->with('error', 'Please enter a student number.');
        }

        $student = User::where('student_number', $studentNumber)
            ->where('role', 'student')
            ->first();

        if (! $student) {
            return redirect()->route('attendance')->with('error', 'No student found matching "' . $studentNumber . '".');
        }

        $attendances = Attendance::where('user_id', $student->id)
            ->latest()
            ->get();

        return view('attendance.show', compact('student', 'attendances'));
    }

    /**
     * Display Student Registration Page
     */
    public function create()
    {
        return view('attendance.register');
    }

    /**
     * Handle Student Registration Submission
     */
    public function storeStudent(Request $request)
    {
        $request->validate([
            'student_number'   => ['required', 'string', 'max:50', 'unique:users,student_number'],
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'year_and_section' => ['required', 'string', 'max:50'],
            'photo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student-photos', 'public');
        }

        $student = User::create([
            'student_number'   => $request->student_number,
            'name'             => trim($request->first_name . ' ' . $request->last_name),
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => strtolower($request->email),
            'year_and_section' => $request->year_and_section,
            'photo'            => $photoPath,
            'password'         => Hash::make($request->password),
            'role'             => 'student',
        ]);

        return redirect()->route('attendance.show', ['student_number' => $student->student_number])
            ->with('success', 'Student registered successfully!');
    }

    /**
     * Log Check-In / Time In
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $student = User::findOrFail($request->user_id);

        Attendance::create([
            'user_id'        => $student->id,
            'student_number' => $student->student_number,
        ]);

        return redirect()->route('attendance.show', ['student_number' => $student->student_number])
            ->with('success', 'Attendance checked in successfully for ' . $student->name . '!');
    }

    /**
     * Show Edit Form for Student Details
     */
    public function edit($id)
    {
        $student = User::where('id', $id)->where('role', 'student')->firstOrFail();

        return view('attendance.edit', compact('student'));
    }

    /**
     * Update Student Profile Details
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $request->validate([
            'student_number'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($student->id)],
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($student->id)],
            'year_and_section' => ['required', 'string', 'max:50'],
            'photo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $student->photo = $request->file('photo')->store('student-photos', 'public');
        }

        $student->student_number   = $request->student_number;
        $student->first_name       = $request->first_name;
        $student->last_name        = $request->last_name;
        $student->name             = trim($request->first_name . ' ' . $request->last_name);
        $student->email            = strtolower($request->email);
        $student->year_and_section = $request->year_and_section;
        $student->save();

        return redirect()->route('attendance.show', ['student_number' => $student->student_number])
            ->with('success', 'Student details updated successfully!');
    }
}