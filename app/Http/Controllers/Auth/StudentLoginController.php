<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StudentLoginController extends Controller
{
    /**
     * Handle an incoming student authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate the form data
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Attempt to log the user in using credentials and remember state
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 3. Check if the authenticated user has the 'student' role
        if (Auth::user()->role !== 'student') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'This portal is restricted to Student accounts only.',
            ]);
        }

        // 4. Regenerate session to prevent session fixation attacks
        $request->session()->regenerate();

        // 5. Redirect to the student destination (e.g., attendance route)
        return redirect()->intended(route('attendance'));
    }
}