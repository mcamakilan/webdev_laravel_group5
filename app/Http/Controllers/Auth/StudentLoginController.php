<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StudentLoginController extends Controller
{
    /**
     * Handle an incoming student authentication request with 2FA
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if ($user->role !== 'student') {
            throw ValidationException::withMessages([
                'email' => 'This portal is restricted to Student accounts only.',
            ]);
        }

        // Generate 2FA code and write to log
        $otp = $user->generateTwoFactorCode();
        Log::info("2FA OTP Code for Student ({$user->email}): {$otp}");

        session([
            '2fa_user_id' => $user->id,
            '2fa_remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('2fa.index')
            ->with('status', 'A 2FA code has been generated. (Test Code: ' . $otp . ')');
    }
}