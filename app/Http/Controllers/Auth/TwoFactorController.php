<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TwoFactorController extends Controller
{
    /**
     * Display the 2FA OTP Entry Form
     */
    public function index()
    {
        if (! session()->has('2fa_user_id')) {
            return redirect()->route('role.selection');
        }

        return view('auth.two-factor');
    }

    /**
     * Verify the entered 2FA OTP code
     */
    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => ['required', 'string', 'size:6'],
        ]);

        $userId = session('2fa_user_id');
        $user = User::find($userId);

        if (! $user || $user->two_factor_code !== $request->two_factor_code || now()->greaterThan($user->two_factor_expires_at)) {
            throw ValidationException::withMessages([
                'two_factor_code' => 'The two-factor verification code is invalid or has expired.',
            ]);
        }

        // Login user and clear session 2FA marker
        Auth::login($user, session('2fa_remember', false));
        $user->resetTwoFactorCode();

        session()->forget(['2fa_user_id', '2fa_remember']);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}