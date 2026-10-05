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

    // Fixed: Pointing directly to StudentRegisterController inside guest middleware
    Route::post('/register/student', [StudentRegisterController::class, 'store'])->name('student.register.submit');
});
// ==============================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::post('/attendance/register-student', [AttendanceController::class, 'registerStudent'])->name('attendance.register-student');
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default Breeze auth routes
require __DIR__.'/auth.php';