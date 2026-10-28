<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
     * Display Master List of All Student Attendance Logs (Admin Only)
     */
    public function logs()
    {
        $logs = Attendance::with('user')->latest()->paginate(20);

        return view('attendance.logs', compact('logs'));
    }

    /**
     * Display Personal Attendance Logs for Logged-In Student
     */
    public function studentLogs()
    {
        $attendances = Attendance::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('attendance.my-logs', compact('attendances'));
    }

    /**
     * Student Self Check-In Action
     */
    public function studentCheckIn(Request $request)
    {
        $user = auth()->user();

        Attendance::create([
            'user_id'        => $user->id,
            'student_number' => $user->student_number ?? 'SELF-' . $user->id,
        ]);

        return redirect()->route('attendance.my-logs')
            ->with('success', 'You have successfully logged your attendance!');
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
     * Handle Student Registration Submission with Automated Password
     */
    public function storeStudent(Request $request)
    {
        $request->validate([
            'student_number'   => ['required', 'string', 'max:50', 'unique:users,student_number'],
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'year_and_section' => ['required', 'string', 'max:50'],
            'college_program'  => ['required', 'string', 'max:255'],
            'photo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->student_number . '.' . $extension;
            $photoPath = $file->storeAs('student-photos', $filename, 'public');
        }

        // Generate strong compliant random password
        $rawPassword = Str::ucfirst(Str::random(3)) . '#' . rand(10, 99) . Str::lower(Str::random(2)) . '!';

        $student = User::create([
            'student_number'   => $request->student_number,
            'name'             => trim($request->first_name . ' ' . $request->last_name),
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => strtolower($request->email),
            'year_and_section' => $request->year_and_section,
            'college_program'  => $request->college_program,
            'photo'            => $photoPath,
            'password'         => Hash::make($rawPassword),
            'role'             => 'student',
        ]);

        return redirect()->route('attendance.show', ['student_number' => $student->student_number])
            ->with('success', 'Student registered successfully! Generated Password: ' . $rawPassword);
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
            'college_program'  => ['required', 'string', 'max:255'],
            'photo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->student_number . '.' . $extension;
            $student->photo = $file->storeAs('student-photos', $filename, 'public');
        }

        $student->student_number   = $request->student_number;
        $student->first_name       = $request->first_name;
        $student->last_name        = $request->last_name;
        $student->name             = trim($request->first_name . ' ' . $request->last_name);
        $student->email            = strtolower($request->email);
        $student->year_and_section = $request->year_and_section;
        $student->college_program  = $request->college_program;
        $student->save();

        return redirect()->route('attendance.show', ['student_number' => $student->student_number])
            ->with('success', 'Student details updated successfully!');
    }
}