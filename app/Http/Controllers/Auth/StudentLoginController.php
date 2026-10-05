<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StudentLoginController extends Controller
{
    /**
     * Handle an incoming student authentication request.
     */
    public function store(Request $request)
    {
        // 1. Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Attempt to log the student in
        // Note: This assumes students are stored in your standard 'users' table.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            // 3. Security: Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // 4. Redirect to where they should go after logging in 
            // I've set it to 'attendance', but you can change it to your student dashboard route
            return redirect()->intended(route('attendance')); 
        }

        // 5. If login fails (wrong password or email), throw an error back to the view
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }
}