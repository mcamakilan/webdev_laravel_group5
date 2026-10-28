<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\TwoFactorController;

Route::get('/', function () {
    return view('welcome');
});

// ==============================================================
// GUEST ROUTES: Role Selection, Login & 2FA
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

    // --- 2FA ROUTES ---
    Route::get('/2fa/verify', [TwoFactorController::class, 'index'])->name('2fa.index');
    Route::post('/2fa/verify', [TwoFactorController::class, 'store'])->name('2fa.store');
});

// ==============================================================
// ADMIN-ONLY ROUTES (Protected by RoleMiddleware)
// ==============================================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Attendance Monitoring Main Landing Page
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');

    // Master Attendance Logs
    Route::get('/attendance/logs', [AttendanceController::class, 'logs'])->name('attendance.logs');
    
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

    // --- USER ACCOUNT MANAGEMENT ROUTES ---
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ==============================================================
// SHARED AUTHENTICATED ROUTES (Accessible by Admins & Students)
// ==============================================================
Route::middleware(['auth', 'verified'])->group(function () {
    // Shared Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Personal Student Attendance Logs & Self Check-In
    Route::get('/my-attendance', [AttendanceController::class, 'studentLogs'])->name('attendance.my-logs');
    Route::post('/my-attendance/check-in', [AttendanceController::class, 'studentCheckIn'])->name('attendance.student-check-in');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default Breeze auth routes
require __DIR__.'/auth.php';