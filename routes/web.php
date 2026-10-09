<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\StudentRegisterController;

Route::get('/', function () {
    return view('welcome');
});

// ==============================================================
// GUEST ROUTES: Role Selection, Student Login & Registration
// ==============================================================
Route::middleware('guest')->group(function () {
    // --- LOGIN ROUTES ---
    Route::get('/login-selection', function () {
        return view('auth.role-selection');
    })->name('role.selection');

    Route::get('/login/student', function () {
        return view('auth.student-login');
    })->name('student.login');

    Route::post('/login/student', [StudentLoginController::class, 'store'])->name('student.login.submit');

    // --- REGISTRATION ROUTES ---
    Route::get('/register-selection', function () {
        return view('auth.register-selection');
    })->name('register.selection');

    Route::get('/register/student', function () {
        return view('auth.student-register');
    })->name('student.register');

    Route::post('/register/student', [StudentRegisterController::class, 'store'])->name('student.register.submit');
});
// ==============================================================

// ==============================================================
// ADMIN-ONLY ROUTES (Protected by RoleMiddleware)
// ==============================================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Attendance Monitoring Main Landing Page
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    
    // View/Scan Lookup Student Attendance
    Route::get('/attendance/view', [AttendanceController::class, 'show'])->name('attendance.show');

    // Student Registration Form & Action
    Route::get('/attendance/register', [AttendanceController::class, 'create'])->name('attendance.register');
    Route::post('/attendance/register', [AttendanceController::class, 'storeStudent'])->name('attendance.store-student');

    // Log Check-In Time
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');

    // Edit Student Details
    Route::get('/attendance/student/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.student.edit');
    Route::put('/attendance/student/{id}', [AttendanceController::class, 'update'])->name('attendance.student.update');
});

// ==============================================================
// SHARED AUTHENTICATED ROUTES (Accessible by Admins & Students)
// ==============================================================
Route::middleware(['auth', 'verified'])->group(function () {
    // Shared Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default Breeze auth routes
require __DIR__.'/auth.php';