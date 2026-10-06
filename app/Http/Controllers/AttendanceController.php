<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Gago boi
        $searchQuery = $request->input('student_number');
        $student = null;
        $attendances = collect(); 

        if ($searchQuery) {
            // Find the student in the database
            $student = User::where('student_number', $searchQuery)->first();

            // If a student is found, get their attendance records ordered by newest first
            if ($student) {
                $attendances = Attendance::where('user_id', $student->id)->latest()->get();
            }
        }

        return view('attendance.index', compact('student', 'searchQuery', 'attendances'));
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'student_number'   => ['required', 'string', 'max:50', 'unique:users,student_number'],
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'mobile_number'    => ['required', 'string', 'max:20'],
            'year_and_section' => ['required', 'string', 'max:50'],
            'photo'            => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student-photos', 'public');
        }

        // Save student details into the users table
        User::create([
            'student_number'   => $request->student_number,
            'name'             => $request->first_name . ' ' . $request->last_name,
            'first_name'       => $request->first_name,
            'last_name'        => $request->last_name,
            'email'            => strtolower($request->student_number) . '@student.temp', // Temporary email placeholder
            'mobile_number'    => $request->mobile_number,
            'year_and_section' => $request->year_and_section,
            'photo'            => $photoPath,
            'password'         => Hash::make('password123'), // Default temporary password
        ]);

        return redirect()->route('attendance')->with('success', 'Student registered successfully!');
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'user_id'        => ['required', 'exists:users,id'],
            'student_number' => ['required', 'string'],
        ]);

        // Log attendance entry
        Attendance::create([
            'user_id'        => $request->user_id,
            'student_number' => $request->student_number,
        ]);

        return redirect()->route('attendance', ['student_number' => $request->student_number])
                         ->with('success', 'Attendance checked in successfully!');
    }
}